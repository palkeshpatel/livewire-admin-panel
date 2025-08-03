<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('welcome');
});

// Authentication routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Admin routes (protected)
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::get('/dashboard', function() {
        return view('layouts.admin');
    })->name('dashboard');
    
    Route::get('/users', function() {
        return view('layouts.admin');
    })->name('users');
    
    Route::get('/products', function() {
        return view('layouts.admin');
    })->name('products');
    
    Route::get('/settings', function() {
        return view('layouts.admin');
    })->name('settings');
});
