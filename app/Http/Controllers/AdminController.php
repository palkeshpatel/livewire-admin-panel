<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Vendor;
use App\Models\Order;
use Inertia\Inertia;

class AdminController extends Controller
{
    public function dashboard()
    {
        return Inertia::render('Admin/Dashboard');
    }

    public function categories()
    {
        $categories = Category::all();
        return Inertia::render('Admin/Categories', [
            'categories' => $categories
        ]);
    }

    public function storeCategory(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:active,inactive'
        ]);

        Category::create($request->all());

        return redirect()->back()->with('message', 'Category created successfully!');
    }

    public function updateCategory(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:active,inactive'
        ]);

        $category->update($request->all());

        return redirect()->back()->with('message', 'Category updated successfully!');
    }

    public function products(Request $request)
    {
        $query = Product::with(['category', 'images']);

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->get('search');
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('sku', 'like', "%{$search}%");
            });
        }

        // Category filter
        if ($request->filled('category')) {
            $query->where('category_id', $request->get('category'));
        }

        // Status filter
        if ($request->filled('status')) {
            $query->where('status', $request->get('status'));
        }

        $products = $query->paginate(10);
        $categories = Category::all();

        return Inertia::render('Admin/Products', [
            'products' => $products,
            'categories' => $categories,
            'filters' => $request->only(['search', 'category', 'status'])
        ]);
    }

    public function exportProducts(Request $request)
    {
        $query = Product::with(['category', 'images']);

        // Apply same filters as products method
        if ($request->filled('search')) {
            $search = $request->get('search');
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('sku', 'like', "%{$search}%");
            });
        }

        if ($request->filled('category')) {
            $query->where('category_id', $request->get('category'));
        }

        if ($request->filled('status')) {
            $query->where('status', $request->get('status'));
        }

        $products = $query->get();

        $filename = 'products_' . date('Y-m-d_H-i-s') . '.csv';
        
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function() use ($products) {
            $file = fopen('php://output', 'w');
            
            // CSV headers
            fputcsv($file, ['ID', 'Name', 'Description', 'Price', 'Category', 'Status', 'SKU', 'Created At']);
            
            // CSV data
            foreach ($products as $product) {
                fputcsv($file, [
                    $product->id,
                    $product->name,
                    $product->description,
                    $product->price,
                    $product->category ? $product->category->name : 'Uncategorized',
                    $product->status,
                    $product->sku,
                    $product->created_at
                ]);
            }
            
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function storeProduct(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'status' => 'required|in:active,inactive',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $product = Product::create($request->except('images'));

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('products', 'public');
                $product->images()->create(['image_path' => $path]);
            }
        }

        return redirect()->back()->with('message', 'Product created successfully!');
    }

    public function updateProduct(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'status' => 'required|in:active,inactive',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $product->update($request->except('images'));

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('products', 'public');
                $product->images()->create(['image_path' => $path]);
            }
        }

        return redirect()->back()->with('message', 'Product updated successfully!');
    }

    public function orders()
    {
        $orders = Order::with(['user', 'items.product'])->paginate(10);
        return Inertia::render('Admin/Orders', [
            'orders' => $orders
        ]);
    }

    public function vendors()
    {
        $vendors = Vendor::all();
        return Inertia::render('Admin/Vendors', [
            'vendors' => $vendors
        ]);
    }

    public function storeVendor(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:vendors,email',
            'phone' => 'required|string|max:20',
            'address' => 'required|string',
            'status' => 'required|in:pending,approved,rejected'
        ]);

        Vendor::create($request->all());

        return redirect()->back()->with('message', 'Vendor created successfully!');
    }

    public function updateVendor(Request $request, Vendor $vendor)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:vendors,email,' . $vendor->id,
            'phone' => 'required|string|max:20',
            'address' => 'required|string',
            'status' => 'required|in:pending,approved,rejected'
        ]);

        $vendor->update($request->all());

        return redirect()->back()->with('message', 'Vendor updated successfully!');
    }

    public function settings()
    {
        $settings = [
            'site_name' => 'Ecommerce Admin',
            'site_description' => 'Multivendor Ecommerce Platform',
            'contact_email' => 'admin@example.com',
            'contact_phone' => '+1234567890',
            'address' => '123 Main St, City, Country',
            'commission_rate' => '10',
            'currency' => 'USD',
            'tax_rate' => '8.5',
            'shipping_cost' => '5.00',
            'min_order_amount' => '25.00'
        ];

        return Inertia::render('Admin/Settings', [
            'settings' => $settings
        ]);
    }

    public function updateSettings(Request $request)
    {
        $request->validate([
            'site_name' => 'required|string|max:255',
            'site_description' => 'nullable|string',
            'contact_email' => 'required|email',
            'contact_phone' => 'required|string',
            'address' => 'required|string',
            'commission_rate' => 'required|numeric|min:0|max:100',
            'currency' => 'required|string|max:3',
            'tax_rate' => 'required|numeric|min:0|max:100',
            'shipping_cost' => 'required|numeric|min:0',
            'min_order_amount' => 'required|numeric|min:0'
        ]);

        // Here you would typically save to a settings table or config file
        // For now, we'll just return success

        return redirect()->back()->with('message', 'Settings updated successfully!');
    }
}
