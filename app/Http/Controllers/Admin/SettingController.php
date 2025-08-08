<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        return view('admin.settings.index');
    }

    public function create()
    {
        return view('admin.settings.create');
    }

    public function store(Request $request)
    {
        // Validation and store logic here
        return redirect()->route('admin.settings.index')->with('success', 'Setting created successfully!');
    }

    public function show($id)
    {
        return view('admin.settings.show');
    }

    public function edit($id)
    {
        return view('admin.settings.edit');
    }

    public function update(Request $request, $id)
    {
        // Validation and update logic here
        return redirect()->route('admin.settings.index')->with('success', 'Setting updated successfully!');
    }

    public function destroy($id)
    {
        // Delete logic here
        return redirect()->route('admin.settings.index')->with('success', 'Setting deleted successfully!');
    }
}
