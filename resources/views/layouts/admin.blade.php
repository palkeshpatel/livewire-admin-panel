<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-gray-50">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }} - Admin</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    <style>
        .sidebar-link {
            transition: all 0.2s ease-in-out;
        }

        .sidebar-link:hover {
            transform: translateX(4px);
        }

        .loading-spinner {
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(360deg);
            }
        }
    </style>
</head>

<body class="h-full font-sans antialiased">
    <div class="min-h-full">
        <!-- Sidebar -->
        <div class="hidden lg:fixed lg:inset-y-0 lg:z-50 lg:flex lg:w-72 lg:flex-col">
            <div
                class="flex grow flex-col gap-y-5 overflow-y-auto bg-white px-6 pb-4 border-r border-gray-200 shadow-lg">
                <div class="flex h-16 shrink-0 items-center">
                    <div class="flex items-center space-x-3">
                        <div
                            class="w-8 h-8 bg-gradient-to-r from-blue-600 to-blue-700 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                            </svg>
                        </div>
                        <h1 class="text-xl font-bold text-gray-900">E-Commerce Admin</h1>
                    </div>
                </div>
                <nav class="flex flex-1 flex-col">
                    <ul role="list" class="flex flex-1 flex-col gap-y-7">
                        <li>
                            <ul role="list" class="-mx-2 space-y-1">
                                <li>
                                    <a href="{{ route('admin.dashboard') }}"
                                        class="sidebar-link group flex gap-x-3 rounded-xl p-3 text-sm leading-6 font-semibold {{ request()->routeIs('admin.dashboard') ? 'bg-blue-50 text-blue-700 border border-blue-200' : 'text-gray-700 hover:text-blue-600 hover:bg-blue-50' }}">
                                        <svg class="h-6 w-6 shrink-0" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                                        </svg>
                                        Dashboard
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.products') }}"
                                        class="sidebar-link group flex gap-x-3 rounded-xl p-3 text-sm leading-6 font-semibold {{ request()->routeIs('admin.products') ? 'bg-blue-50 text-blue-700 border border-blue-200' : 'text-gray-700 hover:text-blue-600 hover:bg-blue-50' }}">
                                        <svg class="h-6 w-6 shrink-0" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                        </svg>
                                        Products
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.users') }}"
                                        class="sidebar-link group flex gap-x-3 rounded-xl p-3 text-sm leading-6 font-semibold {{ request()->routeIs('admin.users') ? 'bg-blue-50 text-blue-700 border border-blue-200' : 'text-gray-700 hover:text-blue-600 hover:bg-blue-50' }}">
                                        <svg class="h-6 w-6 shrink-0" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                                        </svg>
                                        Users
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.settings') }}"
                                        class="sidebar-link group flex gap-x-3 rounded-xl p-3 text-sm leading-6 font-semibold {{ request()->routeIs('admin.settings') ? 'bg-blue-50 text-blue-700 border border-blue-200' : 'text-gray-700 hover:text-blue-600 hover:bg-blue-50' }}">
                                        <svg class="h-6 w-6 shrink-0" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.325.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 011.37.49l1.296 2.247a1.125 1.125 0 01-.26 1.431l-1.003.827c-.293.241-.438.613-.43.992a7.723 7.723 0 01-.227 1.155c-.44.94-1.28 1.57-2.248 1.719a.75.75 0 01-.65-.227l-.684-.606a1.125 1.125 0 00-.771-.31 1.125 1.125 0 00-.771.31l-.684.606a.75.75 0 01-.65.227 7.797 7.797 0 01-2.248-1.719 7.723 7.723 0 01-.227-1.155c-.008-.378.137-.75.43-.992l1.003-.827a1.125 1.125 0 01.374-1.454l1.296-2.247a1.125 1.125 0 011.37-.49l1.217.456c.355.133.75.072 1.075-.124.073-.044.146-.087.22-.127.332-.184.582-.496.645-.87l.213-1.281z" />
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                        Settings
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>

        <!-- Main content -->
        <div class="lg:pl-72">
            <!-- Top bar -->
            <div
                class="sticky top-0 z-40 flex h-16 shrink-0 items-center gap-x-4 border-b border-gray-200 bg-white px-4 shadow-sm sm:gap-x-6 sm:px-6 lg:px-8">
                <div class="flex flex-1 gap-x-4 self-stretch lg:gap-x-6">
                    <div class="flex flex-1"></div>
                    <div class="flex items-center gap-x-4 lg:gap-x-6">
                        <div class="flex items-center space-x-3">
                            <div
                                class="h-8 w-8 rounded-full bg-gradient-to-r from-blue-600 to-blue-700 flex items-center justify-center">
                                <span
                                    class="text-sm font-semibold text-white">{{ substr(auth()->user()->name ?? 'A', 0, 1) }}</span>
                            </div>
                            <div class="hidden md:block">
                                <div class="text-sm font-semibold text-gray-900">{{ auth()->user()->name ?? 'Admin' }}
                                </div>
                                <div class="text-xs text-gray-500">Administrator</div>
                            </div>
                        </div>
                        <form method="POST" action="{{ route('logout') }}" class="ml-4">
                            @csrf
                            <button type="submit"
                                class="text-sm text-gray-500 hover:text-gray-700 transition duration-200 flex items-center space-x-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                                    </path>
                                </svg>
                                <span>Logout</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Page content -->
            <main class="py-8">
                <div class="px-4 sm:px-6 lg:px-8">
                    <!-- Loading indicator -->
                    <div wire:loading class="fixed top-4 right-4 z-50">
                        <div class="bg-blue-600 text-white px-4 py-2 rounded-lg shadow-lg flex items-center space-x-2">
                            <svg class="loading-spinner w-4 h-4" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15">
                                </path>
                            </svg>
                            <span class="text-sm font-medium">Loading...</span>
                        </div>
                    </div>

                    @if (request()->routeIs('admin.dashboard'))
                        @livewire('admin.dashboard')
                    @elseif(request()->routeIs('admin.users'))
                        @livewire('admin.users')
                    @elseif(request()->routeIs('admin.products'))
                        @livewire('admin.products')
                    @elseif(request()->routeIs('admin.settings'))
                        @livewire('admin.settings')
                    @endif
                </div>
            </main>
        </div>
    </div>

    @livewireScripts
    <script>
        // Optimize Livewire loading
        document.addEventListener('livewire:load', function() {
            // Add loading states
            Livewire.hook('message.sent', () => {
                // Show loading indicator
            });

            Livewire.hook('message.processed', () => {
                // Hide loading indicator
            });
        });
    </script>
</body>

</html>
