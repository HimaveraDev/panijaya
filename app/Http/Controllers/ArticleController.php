<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::latest()->paginate(9);
        return view('articles.index', compact('articles'));
    }

    public function show(Article $article)
    {
        $latestArticles = Article::where('id', '!=', $article->id)->latest()->limit(3)->get();
        return view('articles.show', compact('article', 'latestArticles'));
    }
}
