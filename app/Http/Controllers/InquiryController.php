<?php

namespace App\Http\Controllers;

use App\Models\Inquiry;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

use App\Http\Requests\StoreInquiryRequest;
use App\Models\ProductPriceOption;
use App\Models\SiteSetting;

class InquiryController extends Controller
{
    public function store(StoreInquiryRequest $request)
    {
        // Rate Limiter: max 3 requests per IP per minute
        if (RateLimiter::tooManyAttempts('inquiry:' . $request->ip(), 3)) {
            $seconds = RateLimiter::availableIn('inquiry:' . $request->ip());
            return back()->with('error', 'Terlalu banyak percobaan. Harap tunggu ' . $seconds . ' detik.');
        }

        RateLimiter::hit('inquiry:' . $request->ip());

        $validated = $request->validated();

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
            'message'    => $validated['message'] ?? null,
            'status'     => 'new',
        ]);

        // Prepare info for WhatsApp
        $product = Product::findOrFail($validated['product_id']);
        $siteSettings = SiteSetting::get();
        $waNumber = $siteSettings->whatsapp_number;
        $waNumberNormalized = preg_replace('/[^0-9]/', '', $waNumber);
        if (Str::startsWith($waNumberNormalized, '0')) {
            $waNumberNormalized = '62' . substr($waNumberNormalized, 1);
        }

        $message = "Halo Pani Jaya, saya *" . $validated['name'] . "* dari *" . $validated['location'] . "*. \n\nSaya ingin bertanya tentang produk: *" . $product->name . "*.\n\nPesan: " . ($validated['message'] ?? '-');
        $waLink = "https://wa.me/" . $waNumberNormalized . "?text=" . urlencode($message);

        return redirect()->away($waLink);
    }

    public function generateWaMessage(Request $request)
    {
        $product = Product::findOrFail($request->product_id);

        $total = $product->base_price;

        if ($request->has('options')) {
            foreach ($request->options as $optionId) {
                $option = ProductPriceOption::where('product_id', $product->id)
                    ->find($optionId);

                if ($option) {
                    $total += $option->price;
                }
            }
        }

        return response()->json([
            'total' => $total,
            'formatted' => 'Rp ' . number_format($total, 0, ',', '.')
        ]);
    }
}
