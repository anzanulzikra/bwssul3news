<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ExternalArticleController;
use App\Http\Controllers\ContentController;

// Homepage
Route::get('/', [HomeController::class, 'index'])->name('home');

// Article Detail (stays in HomeController for existing URLs)
Route::get('/artikel/{slug}', [HomeController::class, 'articleDetail'])->name('article.detail');

// Content listing routes - clean separation
Route::get('/artikel', [ContentController::class, 'articles'])->name('articles.listing');
Route::get('/artikel-internal', [ArticleController::class, 'index'])->name('articles.internal');
Route::get('/artikel-eksternal', [ExternalArticleController::class, 'index'])->name('articles.external');
Route::get('/gallery', [ContentController::class, 'gallery'])->name('gallery.listing');
Route::get('/publikasi', [ContentController::class, 'publikasi'])->name('publikasi.listing');
