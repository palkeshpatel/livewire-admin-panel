<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    public function index()
    {
        return view('admin.slider.index');
    }

    public function create()
    {
        return view('admin.slider.create');
    }

    public function store(Request $request)
    {
        // Validation and store logic here
        return redirect()->route('admin.slider.index')->with('success', 'Slider created successfully!');
    }

    public function show($id)
    {
        return view('admin.slider.show');
    }

    public function edit($id)
    {
        return view('admin.slider.edit');
    }

    public function update(Request $request, $id)
    {
        // Validation and update logic here
        return redirect()->route('admin.slider.index')->with('success', 'Slider updated successfully!');
    }

    public function destroy($id)
    {
        // Delete logic here
        return redirect()->route('admin.slider.index')->with('success', 'Slider deleted successfully!');
    }
}
