<?php

use Illuminate\Support\Facades\Route;



// Admin Panel Routes
Route::get('/admin', function () {
    return view('admin.dashboard');
})->name('admin.dashboard');

Route::get('/admin/brands', function () {
    return view('admin.brands.index');
})->name('admin.brands');

Route::get('/admin/categories', function () {
    return view('admin.categories.index');
})->name('admin.categories');

Route::get('/admin/coupons', function () {
    return view('admin.coupons.index');
})->name('admin.coupons');

Route::get('/admin/orders', function () {
    return view('admin.orders.index');
})->name('admin.orders');

Route::get('/admin/products', function () {
    return view('admin.products.index');
})->name('admin.products');

Route::get('/admin/settings', function () {
    return view('admin.settings.index');
})->name('admin.settings');

Route::get('/admin/slider', function () {
    return view('admin.slider.index');
})->name('admin.slider');

Route::get('/admin/users', function () {
    return view('admin.users.index');
})->name('admin.users');