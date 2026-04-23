<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\InquiryController;
use App\Http\Controllers\CatalogPdfController;
use Illuminate\Support\Facades\Route;

// Main Pages
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/tentang', [PageController::class, 'about'])->name('about');
Route::get('/pembayaran', [PageController::class, 'payment'])->name('payment');

// Catalog — PDF route MUST come before {slug} wildcard to avoid conflict
Route::get('/katalog/download-pdf', [CatalogPdfController::class, 'download'])->name('catalog.pdf');
Route::get('/katalog', [ProductController::class, 'index'])->name('catalog.index');
Route::get('/katalog/{product:slug}', [ProductController::class, 'show'])->name('catalog.show');

// Articles
Route::get('/artikel', [ArticleController::class, 'index'])->name('article.index');
Route::get('/artikel/{article:slug}', [ArticleController::class, 'show'])->name('article.show');

// Inquiries
Route::post('/inquiry', [InquiryController::class, 'store'])->name('inquiry.store')->middleware('throttle:3,1');
Route::post('/generate-wa-message', [InquiryController::class, 'generateWaMessage'])->name('generate.wa.message');

// Portfolio
Route::get('/portofolio', [PageController::class, 'portfolio'])->name('portfolio');
