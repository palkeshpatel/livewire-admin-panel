@extends('layouts.admin')

@section('title', 'Admin Dashboard')
@section('page-title', 'Dashboard')

@section('content')
    <div>
        @livewire('admin.dashboard-stats')
    </div>
    <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="bg-white dark:bg-gray-800 rounded shadow p-4">
            <h2 class="text-lg font-semibold mb-4">Recent Orders</h2>
            <!-- Placeholder for recent orders -->
            <div class="text-gray-500 dark:text-gray-400">Coming soon...</div>
        </div>
        <div class="bg-white dark:bg-gray-800 rounded shadow p-4">
            <h2 class="text-lg font-semibold mb-4">Top Products</h2>
            <!-- Placeholder for top products -->
            <div class="text-gray-500 dark:text-gray-400">Coming soon...</div>
        </div>
    </div>
@endsection
