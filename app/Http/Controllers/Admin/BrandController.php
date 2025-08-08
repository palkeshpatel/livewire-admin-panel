<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index()
    {
        return view('admin.brands.index');
    }

    public function create()
    {
        return view('admin.brands.create');
    }

    public function store(Request $request)
    {
        // Validation and store logic here
        return redirect()->route('admin.brands.index')->with('success', 'Brand created successfully!');
    }

    public function show($id)
    {
        return view('admin.brands.show');
    }

    public function edit($id)
    {
        return view('admin.brands.edit');
    }

    public function update(Request $request, $id)
    {
        // Validation and update logic here
        return redirect()->route('admin.brands.index')->with('success', 'Brand updated successfully!');
    }

    public function destroy($id)
    {
        // Delete logic here
        return redirect()->route('admin.brands.index')->with('success', 'Brand deleted successfully!');
    }
}
