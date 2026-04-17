<?php

namespace App\Http\Controllers;

use App\Models\Inquiry;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class InquiryController extends Controller
{
    public function store(Request $request)
    {
        // Rate Limiter: max 3 requests per IP per minute
        if (RateLimiter::tooManyAttempts('inquiry:' . $request->ip(), 3)) {
            $seconds = RateLimiter::availableIn('inquiry:' . $request->ip());
            return back()->with('error', 'Terlalu banyak percobaan. Harap tunggu ' . $seconds . ' detik.');
        }

        RateLimiter::hit('inquiry:' . $request->ip());

        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'name'       => 'required|string|max:255',
            'phone'      => 'required|string|max:50',
            'location'   => 'required|string|max:255',
        ]);

        // Phone sanitization: remove non-numeric chars
        $phone = preg_replace('/[^0-9]/', '', $validated['phone']);
        // Normalize prefix (e.g. 08 -> 628, 8 -> 628)
        if (Str::startsWith($phone, '0')) {
            $phone = '62' . substr($phone, 1);
        } elseif (Str::startsWith($phone, '8')) {
            $phone = '62' . $phone;
        }

        // Save to Database
        Inquiry::create([
            'product_id' => $validated['product_id'],
            'name'       => $validated['name'],
            'phone'      => $phone,
            'location'   => $validated['location'],
            'status'     => 'new',
        ]);

        // Prepare info for WhatsApp
        $product = Product::findOrFail($validated['product_id']);
        $waNumber = config('services.panijaya.wa_number', '628123456789');

        $message = "Halo Pani Jaya, saya *" . $validated['name'] . "* dari *" . $validated['location'] . "*. \n\nSaya ingin bertanya tentang produk: *" . $product->name . "*.";
        $waLink = "https://wa.me/" . $waNumber . "?text=" . urlencode($message);

        // Redirect directly to WhatsApp without target blank (since logic is handled in controller now)
        // Note: the `target="_blank"` on the form will open this route in a new tab if used,
        // but the prompt said "Hapus target='_blank'" from the form.
        // Therefore, this redirect will happen in the same window.
        return redirect()->away($waLink);
    }
}
