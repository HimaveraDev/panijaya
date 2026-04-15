<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Article;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home()
    {
        $categories = Category::limit(4)->get();
        $featuredProducts = Product::where('is_featured', true)->latest()->limit(8)->get();
        $latestArticles = Article::latest()->limit(3)->get();
        $testimonials = Testimonial::where('is_active', true)->latest()->get();

        return view('index', compact('categories', 'featuredProducts', 'latestArticles', 'testimonials'));
    }

    public function about()
    {
        return view('about');
    }

    public function payment()
    {
        return view('payment');
    }
}
