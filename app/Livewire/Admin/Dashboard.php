<?php

namespace App\Livewire\Admin;

use App\Models\User;
use App\Models\Product;
use Livewire\Component;
use Illuminate\Support\Facades\Cache;

class Dashboard extends Component
{
    public $totalUsers;
    public $totalProducts;
    public $recentUsers;
    public $recentProducts;

    public function mount()
    {
        $this->loadStats();
    }

    public function loadStats()
    {
        // Cache statistics for better performance
        $this->totalUsers = Cache::remember('total_users', 300, function () {
            return User::count();
        });
        
        $this->totalProducts = Cache::remember('total_products', 300, function () {
            return Product::count();
        });
        
        $this->recentUsers = Cache::remember('recent_users', 60, function () {
            return User::latest()->take(5)->get();
        });
        
        $this->recentProducts = Cache::remember('recent_products', 60, function () {
            return Product::latest()->take(5)->get();
        });
    }

    public function render()
    {
        return view('livewire.admin.dashboard');
    }
} 