<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Models\Vendor;
use App\Helpers\CurrencyHelper;

class DashboardStats extends Component
{
    public $stats = [];
    public $currency = 'INR';

    public function mount()
    {
        $this->loadStats();
    }

    public function loadStats()
    {
        $this->stats = [
            'total_orders' => Order::count(),
            'delivered_orders' => Order::where('status', 'delivered')->count(),
            'total_amount' => Order::sum('total_amount'),
            'delivered_amount' => Order::where('status', 'delivered')->sum('total_amount'),
            'pending_orders' => Order::where('status', 'pending')->count(),
            'canceled_orders' => Order::where('status', 'canceled')->count(),
            'pending_amount' => Order::where('status', 'pending')->sum('total_amount'),
            'canceled_amount' => Order::where('status', 'canceled')->sum('total_amount'),
        ];
    }

    public function formatCurrency($amount)
    {
        return CurrencyHelper::format($amount, $this->currency);
    }

    public function render()
    {
        return view('livewire.admin.dashboard-stats');
    }
}
