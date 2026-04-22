<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Article;
use App\Models\Testimonial;
use App\Models\ProjectGallery;

class PageController extends Controller
{
    public function home()
    {
        $categories = Category::limit(4)->get();
        $featuredProducts = Product::with('category')->where('is_featured', true)->latest()->limit(8)->get();
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

    public function portfolio()
    {
        $projects = ProjectGallery::latest('installation_date')->paginate(12);
        return view('portfolio', compact('projects'));
    }
}
