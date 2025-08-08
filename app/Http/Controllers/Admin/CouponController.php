<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function index()
    {
        return view('admin.coupons.index');
    }

    public function create()
    {
        return view('admin.coupons.create');
    }

    public function store(Request $request)
    {
        // Validation and store logic here
        return redirect()->route('admin.coupons.index')->with('success', 'Coupon created successfully!');
    }

    public function show($id)
    {
        return view('admin.coupons.show');
    }

    public function edit($id)
    {
        return view('admin.coupons.edit');
    }

    public function update(Request $request, $id)
    {
        // Validation and update logic here
        return redirect()->route('admin.coupons.index')->with('success', 'Coupon updated successfully!');
    }

    public function destroy($id)
    {
        // Delete logic here
        return redirect()->route('admin.coupons.index')->with('success', 'Coupon deleted successfully!');
    }
}
