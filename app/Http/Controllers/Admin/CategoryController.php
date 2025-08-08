<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        return view('admin.categories.index');
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        // Validation and store logic here
        return redirect()->route('admin.categories.index')->with('success', 'Category created successfully!');
    }

    public function show($id)
    {
        return view('admin.categories.show');
    }

    public function edit($id)
    {
        return view('admin.categories.edit');
    }

    public function update(Request $request, $id)
    {
        // Validation and update logic here
        return redirect()->route('admin.categories.index')->with('success', 'Category updated successfully!');
    }

    public function destroy($id)
    {
        // Delete logic here
        return redirect()->route('admin.categories.index')->with('success', 'Category deleted successfully!');
    }
}
