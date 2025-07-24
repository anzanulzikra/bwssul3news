<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index'])->name('home.index');
Route::get('/artikel/{slug}', [HomeController::class, 'articleDetail'])->name('article.detail');
