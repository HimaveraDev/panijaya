<?php

namespace App\Http\Controllers;

use App\Models\Inquiry;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Requests\StoreInquiryRequest;
use App\Models\ProductPriceOption;
use App\Models\SiteSetting;

class InquiryController extends Controller
{
    public function store(StoreInquiryRequest $request)
    {
        $validated = $request->validated();

        // Save to Database
        Inquiry::create([
            'product_id' => $validated['product_id'],
            'name'       => $validated['name'],
            'phone'      => $validated['phone'], // Phone is already sanitized via StoreInquiryRequest
            'location'   => $validated['location'],
            'message'    => $validated['message'] ?? null,
            'status'     => 'new',
        ]);

        // Prepare info for WhatsApp
        $product = Product::findOrFail($validated['product_id']);
        
        $siteSettings = SiteSetting::first();
        $waNumber = $siteSettings->whatsapp_number;
        $waNumberNormalized = preg_replace('/[^0-9]/', '', $waNumber);
        
        if (Str::startsWith($waNumberNormalized, '0')) {
            $waNumberNormalized = '62' . substr($waNumberNormalized, 1);
        }

        // Use the message passed from frontend (which includes options and validated price)
        $frontendMessage = $validated['message'] ?? '';
        
        $message = "Halo Pani Jaya, saya *" . $validated['name'] . "* dari *" . $validated['location'] . "*. \n\n" . $frontendMessage;
        
        $waLink = "https://wa.me/" . $waNumberNormalized . "?text=" . urlencode($message);

        return redirect()->away($waLink);
    }

    public function generateWaMessage(Request $request)
    {
        // Validate inputs before processing
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'options'    => 'nullable|array',
            'options.*'  => 'exists:product_price_options,id',
        ]);

        $product = Product::findOrFail($request->product_id);
        $total = $product->base_price;

        if ($request->has('options') && is_array($request->options)) {
            // N+1 Query Optimization: Use a single query with whereIn and sum
            $optionsTotal = ProductPriceOption::where('product_id', $product->id)
                ->whereIn('id', $request->options)
                ->sum('price');
                
            $total += $optionsTotal;
        }

        return response()->json([
            'total' => $total,
            'formatted' => 'Rp ' . number_format($total, 0, ',', '.')
        ]);
    }
}
