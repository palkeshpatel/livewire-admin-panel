<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="antialiased">
    <div
        class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white">
        <div class="max-w-7xl mx-auto p-6 lg:p-8">
            <div class="flex justify-center">
                <h1 class="text-4xl font-bold text-gray-900 mb-8">
                    Ecommerce Multivendor Admin Panel
                </h1>
            </div>

            <div class="mt-16">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8">
                    <div
                        class="scale-100 p-6 bg-white from-gray-700/50 via-transparent rounded-lg shadow-2xl shadow-gray-500/20 flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500">
                        <div>
                            <h2 class="text-xl font-semibold text-gray-900">Admin Panel</h2>
                            <p class="mt-4 text-gray-500 text-sm leading-relaxed">
                                Access the admin panel to manage categories, products, vendors, and orders.
                            </p>
                            <div class="mt-4">
                                <a href="/login"
                                    class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    Login to Admin Panel
                                </a>
                            </div>
                        </div>
                    </div>

                    <div
                        class="scale-100 p-6 bg-white from-gray-700/50 via-transparent rounded-lg shadow-2xl shadow-gray-500/20 flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500">
                        <div>
                            <h2 class="text-xl font-semibold text-gray-900">Features</h2>
                            <p class="mt-4 text-gray-500 text-sm leading-relaxed">
                                Built with Laravel, Inertia.js, and React for a modern admin experience.
                            </p>
                            <ul class="mt-4 text-gray-500 text-sm">
                                <li>• Category Management</li>
                                <li>• Product Management with Multiple Images</li>
                                <li>• Vendor Management</li>
                                <li>• Order Management</li>
                                <li>• System Settings</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
