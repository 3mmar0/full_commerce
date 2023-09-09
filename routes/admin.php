<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use Illuminate\Support\Facades\Route;




Route::group([
    'middleware' => ['auth'],
    'as' => 'dashboard.',
    'prefix' => 'dashboard'
], function () {
    Route::get('/', function () {
        return view('admin.index');
    })->name('dashboard');
    Route::resource('/categories', CategoryController::class);
    Route::post('/categories/{id}', [CategoryController::class, 'update']);
    Route::resource('/products', ProductController::class);
});