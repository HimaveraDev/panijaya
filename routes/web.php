<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

// Main Pages
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/tentang', [PageController::class, 'about'])->name('about');
Route::get('/pembayaran', [PageController::class, 'payment'])->name('payment');

// Catalog
Route::get('/katalog', [ProductController::class, 'index'])->name('catalog.index');
Route::get('/katalog/{product:slug}', [ProductController::class, 'show'])->name('catalog.show');

// Articles
Route::get('/artikel', [ArticleController::class, 'index'])->name('article.index');
Route::get('/artikel/{article:slug}', [ArticleController::class, 'show'])->name('article.show');
