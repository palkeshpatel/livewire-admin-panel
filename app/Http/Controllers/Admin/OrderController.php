<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        return view('admin.orders.index');
    }

    public function create()
    {
        return view('admin.orders.create');
    }

    public function store(Request $request)
    {
        // Validation and store logic here
        return redirect()->route('admin.orders.index')->with('success', 'Order created successfully!');
    }

    public function show($id)
    {
        return view('admin.orders.show');
    }

    public function edit($id)
    {
        return view('admin.orders.edit');
    }

    public function update(Request $request, $id)
    {
        // Validation and update logic here
        return redirect()->route('admin.orders.index')->with('success', 'Order updated successfully!');
    }

    public function destroy($id)
    {
        // Delete logic here
        return redirect()->route('admin.orders.index')->with('success', 'Order deleted successfully!');
    }

    public function tracking()
    {
        return view('admin.orders.tracking');
    }
}
