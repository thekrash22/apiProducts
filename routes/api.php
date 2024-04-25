<?php

use App\Http\Controllers\Api\CustomAuthController;
use App\Http\Controllers\Api\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::controller(ProductController::class)->prefix('products')->group(function () {
    Route::post('/', 'store')->name('products.store');
    Route::get('/listall', 'listAll')->name('products.listall');
    Route::put('/{product}', 'update')->name('products.update');
    Route::delete('/{product}', 'destroy')->name('products.destroy');
    Route::get('/{product}', 'show')->name('products.show');
})->middleware('auth:sanctum');

Route::controller(CustomAuthController::class)->group(function () {
    Route::post('register', 'register');
    Route::post('login', 'login')->name('login');
    Route::get('logout', 'logout')->middleware('auth:sanctum');
});
