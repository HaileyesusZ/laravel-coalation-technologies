<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('products/index');
});

Route::resources([
    'products' => ProductController::class,
]);
