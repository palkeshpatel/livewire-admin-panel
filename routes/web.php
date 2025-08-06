<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use Livewire\Livewire;

Route::get('/', function () {
    return view('welcome');
});

// Admin Auth
Route::get('/admin/login', [AuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'login'])->name('admin.login.submit');
Route::post('/admin/logout', [AuthController::class, 'logout'])->name('admin.logout');

// Admin Panel (protected)
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/products', function () {
        return view('admin.products');
    })->name('products');
    Route::get('/categories', function () {
        return view('admin.categories');
    })->name('categories');
    Route::get('/orders', function () {
        return view('admin.orders');
    })->name('orders');
    Route::get('/vendors', function () {
        return view('admin.vendors');
    })->name('vendors');
    Route::get('/settings', function () {
        return view('admin.settings');
    })->name('settings');
});