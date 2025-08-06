<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Models\Vendor;
use App\Helpers\CurrencyHelper;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_orders' => Order::count(),
            'total_products' => Product::count(),
            'total_vendors' => Vendor::count(),
            'total_customers' => User::where('role', 'customer')->count(),
            'total_revenue' => Order::where('status', 'delivered')->sum('total_amount'),
            'pending_orders' => Order::where('status', 'pending')->count(),
            'delivered_orders' => Order::where('status', 'delivered')->count(),
            'canceled_orders' => Order::where('status', 'canceled')->count(),
        ];

        $recent_orders = Order::with(['user', 'vendor'])->latest()->take(5)->get();
        $top_products = Product::with('vendor')->orderBy('stock', 'desc')->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recent_orders', 'top_products'));
    }
}
