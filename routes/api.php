<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::controller(CategoryController::class)
    ->prefix('/categories')
    ->group(function () {
        Route::get('/', 'index');
    });

Route::controller(ProductController::class)
    ->prefix('/products')
    ->group(function () {
        Route::get('/', 'index');
    });
