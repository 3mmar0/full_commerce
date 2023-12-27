<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProfileController;
use Illuminate\Support\Facades\Route;

Route::group([
    'middleware' => ['auth:admin'],
    'as' => 'dashboard.',
    'prefix' => 'admin/dashboard'
], function () {
    Route::get('/', function () {
        return view('admin.index');
    })->name('dashboard');
    Route::get('profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::resource('/categories', CategoryController::class);
    Route::post('/categories/{id}', [CategoryController::class, 'update']);
    Route::resource('/products', ProductController::class);
});
