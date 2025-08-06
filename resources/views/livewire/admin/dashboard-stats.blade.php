<div class="fade-in">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-8">
        <!-- Total Orders -->
        <div class="admin-card-gradient p-8 hover-lift">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-blue-100 text-sm font-semibold mb-2">Total Orders</p>
                    <p class="text-4xl font-bold text-white mb-1">{{ $stats['total_orders'] }}</p>
                    <p class="text-blue-200 text-xs">All time orders</p>
                </div>
                <div
                    class="w-16 h-16 bg-white/20 backdrop-blur-sm rounded-2xl flex items-center justify-center shadow-beautiful">
                    <i class="fas fa-shopping-bag text-white text-2xl"></i>
                </div>
            </div>
        </div>

        <!-- Delivered Orders -->
        <div class="admin-card-gradient p-8 hover-lift"
            style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-blue-100 text-sm font-semibold mb-2">Delivered Orders</p>
                    <p class="text-4xl font-bold text-white mb-1">{{ $stats['delivered_orders'] }}</p>
                    <p class="text-blue-200 text-xs">Successfully delivered</p>
                </div>
                <div
                    class="w-16 h-16 bg-white/20 backdrop-blur-sm rounded-2xl flex items-center justify-center shadow-beautiful">
                    <i class="fas fa-check-circle text-white text-2xl"></i>
                </div>
            </div>
        </div>

        <!-- Total Revenue -->
        <div class="admin-card-gradient p-8 hover-lift"
            style="background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-blue-100 text-sm font-semibold mb-2">Total Revenue</p>
                    <p class="text-4xl font-bold text-white mb-1">{{ $this->formatCurrency($stats['total_amount']) }}
                    </p>
                    <p class="text-blue-200 text-xs">All time earnings</p>
                </div>
                <div
                    class="w-16 h-16 bg-white/20 backdrop-blur-sm rounded-2xl flex items-center justify-center shadow-beautiful">
                    <i class="fas fa-dollar-sign text-white text-2xl"></i>
                </div>
            </div>
        </div>

        <!-- Delivered Revenue -->
        <div class="admin-card-gradient p-8 hover-lift"
            style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-blue-100 text-sm font-semibold mb-2">Delivered Revenue</p>
                    <p class="text-4xl font-bold text-white mb-1">
                        {{ $this->formatCurrency($stats['delivered_amount']) }}</p>
                    <p class="text-blue-200 text-xs">From delivered orders</p>
                </div>
                <div
                    class="w-16 h-16 bg-white/20 backdrop-blur-sm rounded-2xl flex items-center justify-center shadow-beautiful">
                    <i class="fas fa-chart-line text-white text-2xl"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
        <!-- Pending Orders -->
        <div class="admin-card p-8 hover-lift">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 dark:text-gray-400 text-sm font-semibold mb-2">Pending Orders</p>
                    <p class="text-4xl font-bold text-gray-900 dark:text-white mb-1">{{ $stats['pending_orders'] }}</p>
                    <p class="text-gray-500 dark:text-gray-400 text-xs">Awaiting processing</p>
                </div>
                <div
                    class="w-16 h-16 bg-yellow-100 dark:bg-yellow-900 rounded-2xl flex items-center justify-center shadow-beautiful">
                    <i class="fas fa-clock text-yellow-600 dark:text-yellow-400 text-2xl"></i>
                </div>
            </div>
        </div>

        <!-- Pending Revenue -->
        <div class="admin-card p-8 hover-lift">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 dark:text-gray-400 text-sm font-semibold mb-2">Pending Revenue</p>
                    <p class="text-4xl font-bold text-gray-900 dark:text-white mb-1">
                        {{ $this->formatCurrency($stats['pending_amount']) }}</p>
                    <p class="text-gray-500 dark:text-gray-400 text-xs">From pending orders</p>
                </div>
                <div
                    class="w-16 h-16 bg-orange-100 dark:bg-orange-900 rounded-2xl flex items-center justify-center shadow-beautiful">
                    <i class="fas fa-hourglass-half text-orange-600 dark:text-orange-400 text-2xl"></i>
                </div>
            </div>
        </div>

        <!-- Canceled Orders -->
        <div class="admin-card p-8 hover-lift">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 dark:text-gray-400 text-sm font-semibold mb-2">Canceled Orders</p>
                    <p class="text-4xl font-bold text-gray-900 dark:text-white mb-1">{{ $stats['canceled_orders'] }}</p>
                    <p class="text-gray-500 dark:text-gray-400 text-xs">Cancelled by customers</p>
                </div>
                <div
                    class="w-16 h-16 bg-red-100 dark:bg-red-900 rounded-2xl flex items-center justify-center shadow-beautiful">
                    <i class="fas fa-times-circle text-red-600 dark:text-red-400 text-2xl"></i>
                </div>
            </div>
        </div>

        <!-- Canceled Revenue -->
        <div class="admin-card p-8 hover-lift">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 dark:text-gray-400 text-sm font-semibold mb-2">Canceled Revenue</p>
                    <p class="text-4xl font-bold text-gray-900 dark:text-white mb-1">
                        {{ $this->formatCurrency($stats['canceled_amount']) }}</p>
                    <p class="text-gray-500 dark:text-gray-400 text-xs">From cancelled orders</p>
                </div>
                <div
                    class="w-16 h-16 bg-gray-100 dark:bg-gray-700 rounded-2xl flex items-center justify-center shadow-beautiful">
                    <i class="fas fa-ban text-gray-600 dark:text-gray-400 text-2xl"></i>
                </div>
            </div>
        </div>
    </div>
</div>
