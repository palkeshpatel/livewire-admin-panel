<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('welcome');
});

// Auth routes
Route::get('/login', function () {
    return Inertia::render('Admin/Login');
})->name('login');

Route::post('/login', [AuthController::class, 'login']);

// Admin routes (protected)
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Admin/Dashboard');
    })->name('dashboard');

    // Categories
    Route::get('/categories', [AdminController::class, 'categories'])->name('categories');
    Route::post('/categories', [AdminController::class, 'storeCategory'])->name('categories.store');
    Route::put('/categories/{category}', [AdminController::class, 'updateCategory'])->name('categories.update');

    // Products
    Route::get('/products', [AdminController::class, 'products'])->name('products');
    Route::post('/products', [AdminController::class, 'storeProduct'])->name('products.store');
    Route::put('/products/{product}', [AdminController::class, 'updateProduct'])->name('products.update');
    Route::get('/products/export', [AdminController::class, 'exportProducts'])->name('products.export');

    // Orders
    Route::get('/orders', [AdminController::class, 'orders'])->name('orders');

    // Vendors
    Route::get('/vendors', [AdminController::class, 'vendors'])->name('vendors');
    Route::post('/vendors', [AdminController::class, 'storeVendor'])->name('vendors.store');
    Route::put('/vendors/{vendor}', [AdminController::class, 'updateVendor'])->name('vendors.update');

    // Settings
    Route::get('/settings', [AdminController::class, 'settings'])->name('settings');
    Route::post('/settings', [AdminController::class, 'updateSettings'])->name('settings.update');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');