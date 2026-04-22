<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\PricingSetting;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();
        $query = Product::query()->with('category');

        if ($request->has('kategori')) {
            $query->whereHas('category', function($q) use ($request) {
                $q->where('slug', $request->kategori);
            });
        }

        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $products = $query->latest()->paginate(12)->withQueryString();

        // Ambil pricing dari DB; fallback otomatis ke config jika tabel kosong
        $pricingConfig = PricingSetting::toPricingConfig();

        return view('catalog', compact('products', 'categories', 'pricingConfig'));
    }

    public function show(Product $product)
    {
        $relatedProducts = Product::with('category')->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->limit(4)
            ->get();

        return view('products.show', compact('product', 'relatedProducts'));
    }
}
