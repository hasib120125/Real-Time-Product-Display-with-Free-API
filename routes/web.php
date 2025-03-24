<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::get('/', [ProductController::class, 'index'])->name('products.index');
Route::get('/fetch-products', [ProductController::class, 'fetchProducts'])->name('products.fetch');
