<!DOCTYPE html>
<html lang="en" x-data="{ dark: localStorage.getItem('theme') === 'dark', sidebarOpen: window.innerWidth < 1024 ? false : true }" x-bind:class="dark ? 'dark' : ''" x-init="$watch('dark', val => localStorage.setItem('theme', val ? 'dark' : 'light'));
$watch('sidebarOpen', val => { if (window.innerWidth >= 1024) sidebarOpen = true })">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel') - MultiVendor</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script src="{{ asset('vendor/livewire/livewire.js') }}" defer></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body
    class="bg-gradient-to-br from-gray-50 to-blue-50 dark:from-gray-900 dark:to-gray-800 text-gray-900 dark:text-gray-100 min-h-screen">
    <!-- Mobile sidebar overlay -->
    <div x-show="sidebarOpen" x-transition:enter="transition-opacity ease-linear duration-300"
        x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
        x-transition:leave="transition-opacity ease-linear duration-300" x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0" class="fixed inset-0 z-40 lg:hidden bg-black bg-opacity-50 backdrop-blur-sm"
        @click="sidebarOpen = false"></div>

    <div class="flex min-h-screen">
        <!-- Beautiful Sidebar - Always visible on desktop -->
        <div class="fixed inset-y-0 left-0 z-50 w-72 admin-sidebar lg:relative lg:translate-x-0 lg:block"
            x-show="sidebarOpen" x-transition:enter="transition ease-in-out duration-300 transform"
            x-transition:enter-start="-translate-x-full" x-transition:enter-end="translate-x-0"
            x-transition:leave="transition ease-in-out duration-300 transform" x-transition:leave-start="translate-x-0"
            x-transition:leave-end="-translate-x-full">
            <div class="flex items-center justify-between h-20 px-6 bg-black/20 backdrop-blur-sm">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div
                            class="w-12 h-12 bg-white/20 backdrop-blur-sm rounded-2xl flex items-center justify-center shadow-beautiful">
                            <i class="fas fa-store text-white text-2xl"></i>
                        </div>
                    </div>
                    <div class="ml-4">
                        <h1 class="text-white font-bold text-xl">MultiVendor</h1>
                        <p class="text-blue-200 text-sm">Admin Panel</p>
                    </div>
                </div>
                <button @click="sidebarOpen = false" class="text-white hover:text-blue-200 transition-colors">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>

            <nav class="mt-8 px-6 space-y-2">
                <a href="{{ route('admin.dashboard') }}"
                    class="admin-sidebar-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="fas fa-tachometer-alt w-6 h-6 mr-4 icon-beautiful"></i>
                    <span class="font-semibold">Dashboard</span>
                </a>

                <a href="{{ route('admin.products') }}"
                    class="admin-sidebar-item {{ request()->routeIs('admin.products') ? 'active' : '' }}">
                    <i class="fas fa-box w-6 h-6 mr-4 icon-beautiful"></i>
                    <span class="font-semibold">Products</span>
                </a>

                <a href="{{ route('admin.categories') }}"
                    class="admin-sidebar-item {{ request()->routeIs('admin.categories') ? 'active' : '' }}">
                    <i class="fas fa-tags w-6 h-6 mr-4 icon-beautiful"></i>
                    <span class="font-semibold">Categories</span>
                </a>

                <a href="{{ route('admin.orders') }}"
                    class="admin-sidebar-item {{ request()->routeIs('admin.orders') ? 'active' : '' }}">
                    <i class="fas fa-shopping-cart w-6 h-6 mr-4 icon-beautiful"></i>
                    <span class="font-semibold">Orders</span>
                </a>

                <a href="{{ route('admin.vendors') }}"
                    class="admin-sidebar-item {{ request()->routeIs('admin.vendors') ? 'active' : '' }}">
                    <i class="fas fa-store-alt w-6 h-6 mr-4 icon-beautiful"></i>
                    <span class="font-semibold">Vendors</span>
                </a>

                <a href="{{ route('admin.settings') }}"
                    class="admin-sidebar-item {{ request()->routeIs('admin.settings') ? 'active' : '' }}">
                    <i class="fas fa-cog w-6 h-6 mr-4 icon-beautiful"></i>
                    <span class="font-semibold">Settings</span>
                </a>
            </nav>

            <div class="absolute bottom-0 left-0 right-0 p-6">
                <form method="POST" action="{{ route('admin.logout') }}">
                    @csrf
                    <button type="submit" class="w-full btn-danger">
                        <i class="fas fa-sign-out-alt w-5 h-5 mr-3"></i>
                        <span class="font-semibold">Logout</span>
                    </button>
                </form>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col lg:ml-0">
            <!-- Beautiful Topbar -->
            <header
                class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm shadow-sm border-b border-gray-200/50 dark:border-gray-700/50">
                <div class="flex items-center justify-between px-8 py-4">
                    <div class="flex items-center">
                        <button @click="sidebarOpen = true"
                            class="lg:hidden text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200 mr-6 transition-colors">
                            <i class="fas fa-bars text-2xl"></i>
                        </button>
                        <button @click="sidebarOpen = !sidebarOpen"
                            class="hidden lg:block text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200 mr-6 transition-colors">
                            <i class="fas fa-bars text-2xl"></i>
                        </button>
                        <h1 class="admin-title">@yield('page-title', 'Dashboard')</h1>
                    </div>

                    <div class="flex items-center space-x-6">
                        <button @click="dark = !dark"
                            class="p-3 rounded-2xl bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 transition-all duration-300 hover-lift">
                            <i x-show="!dark" class="fas fa-moon text-gray-600 dark:text-gray-400 text-xl"></i>
                            <i x-show="dark" class="fas fa-sun text-yellow-500 text-xl"></i>
                        </button>

                        <div class="flex items-center space-x-4">
                            <div
                                class="w-12 h-12 gradient-primary rounded-2xl flex items-center justify-center shadow-beautiful">
                                <i class="fas fa-user text-white text-lg"></i>
                            </div>
                            <div class="hidden md:block">
                                <p class="text-sm font-semibold text-gray-900 dark:text-white">
                                    {{ Auth::user()->name ?? 'Admin' }}</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">Administrator</p>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 p-6">
                <div class="fade-in">
                    @yield('content')
                </div>
                @stack('modals')
            </main>
        </div>
    </div>
    @livewireScripts
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            console.log('DOM loaded');
            if (typeof Livewire !== 'undefined') {
                console.log('Livewire is loaded');
            } else {
                console.log('Livewire is NOT loaded');
            }
        });
    </script>
</body>

</html>
