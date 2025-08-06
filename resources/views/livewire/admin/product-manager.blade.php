<div class="fade-in" x-data="{}" x-init="console.log('Alpine.js is working');
$wire && console.log('Livewire is working');"
    @console-log.window="console.log($event.detail.message)">


    <!-- Header -->
    <div class="mb-6">
        <h2 class="admin-title">Product Management</h2>
        <p class="admin-subtitle mt-2">Manage your products and inventory</p>
    </div>

    <!-- Search and Add Product -->
    <div class="admin-card p-4 mb-6">
        <div class="flex items-center gap-4">
            <div class="flex-1 max-w-md">
                <div class="relative">
                    <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                    <input wire:model.live="search" type="text" placeholder="Search products..."
                        class="form-input pl-10 h-10 text-sm">
                </div>
            </div>
            <button wire:click="showAddProduct" class="btn-primary px-4 py-2 text-sm">
                <i class="fas fa-plus mr-2"></i>
                Add Product
            </button>
            <button onclick="console.log('JavaScript click works');" class="btn-secondary px-4 py-2 text-sm ml-2">
                Test JS
            </button>
            <button wire:click="$set('showAddForm', true)" class="btn-secondary px-4 py-2 text-sm ml-2">
                Test Livewire
            </button>
        </div>
    </div>

    <!-- Add/Edit Form -->
    @if ($showAddForm)
        <!-- Simple Test Modal -->
        <div class="fixed inset-0 bg-red-500 bg-opacity-75 z-[9999] flex items-center justify-center p-4">
            <div class="bg-white p-8 rounded-lg shadow-xl">
                <h3 class="text-2xl font-bold mb-4">Modal is Working!</h3>
                <p>If you can see this, the modal system is working.</p>
                <button wire:click="cancelEdit" class="btn-primary mt-4">Close</button>
            </div>
        </div>

        <!-- Original Modal -->
        <div class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4"
            wire:click="cancelEdit">
            <div class="admin-card p-6 mb-6 w-full max-w-4xl max-h-[90vh] overflow-y-auto" wire:click.stop>
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white">
                        {{ $editingProduct ? 'Edit Product' : 'Add New Product' }}
                    </h3>
                    <button wire:click="cancelEdit"
                        class="text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200 transition-colors">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
                <div class="absolute top-4 right-4">
                    <button wire:click="cancelEdit"
                        class="text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200 transition-colors">
                        <i class="fas fa-times text-2xl"></i>
                    </button>
                </div>

                <form wire:submit="saveProduct">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <!-- Left Column -->
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Product
                                    Name *</label>
                                <input wire:model="name" type="text" placeholder="Enter product name"
                                    class="form-input {{ $errors->has('name') ? 'error' : '' }}">
                                @error('name')
                                    <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Slug
                                    *</label>
                                <input wire:model="slug" type="text" placeholder="product-slug"
                                    class="form-input {{ $errors->has('slug') ? 'error' : '' }}">
                                @error('slug')
                                    <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label
                                        class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Category
                                        *</label>
                                    <select wire:model="category_id" class="form-input">
                                        <option value="">Select Category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div>
                                    <label
                                        class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Vendor
                                        *</label>
                                    <select wire:model="vendor_id" class="form-input">
                                        <option value="">Select Vendor</option>
                                        @foreach ($vendors as $vendor)
                                            <option value="{{ $vendor->id }}">{{ $vendor->shop_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('vendor_id')
                                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div>
                                <label
                                    class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Description</label>
                                <textarea wire:model="description" rows="3" placeholder="Enter product description..." class="form-input"></textarea>
                                @error('description')
                                    <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- Right Column -->
                        <div class="space-y-4">
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label
                                        class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Price
                                        *</label>
                                    <div class="relative">
                                        <span
                                            class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500 font-semibold">₹</span>
                                        <input wire:model="price" type="number" step="0.01" placeholder="0.00"
                                            class="form-input pl-8">
                                    </div>
                                    @error('price')
                                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div>
                                    <label
                                        class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Sale
                                        Price</label>
                                    <div class="relative">
                                        <span
                                            class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500 font-semibold">₹</span>
                                        <input wire:model="sale_price" type="number" step="0.01" placeholder="0.00"
                                            class="form-input pl-8">
                                    </div>
                                    @error('sale_price')
                                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label
                                        class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Stock
                                        *</label>
                                    <input wire:model="stock" type="number" placeholder="0" class="form-input">
                                    @error('stock')
                                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div>
                                    <label
                                        class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">SKU</label>
                                    <input wire:model="sku" type="text" placeholder="SKU123" class="form-input">
                                    @error('sku')
                                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label
                                        class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Status</label>
                                    <select wire:model="status" class="form-input">
                                        <option value="active">Active</option>
                                        <option value="inactive">Inactive</option>
                                    </select>
                                </div>

                                <div>
                                    <label
                                        class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Featured</label>
                                    <select wire:model="featured" class="form-input">
                                        <option value="0">No</option>
                                        <option value="1">Yes</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end gap-4 mt-6 pt-6 border-t border-gray-200 dark:border-gray-700">
                        <button type="button" wire:click="cancelEdit" class="btn-secondary"
                            wire:loading.attr="disabled">
                            Cancel
                        </button>
                        <button type="submit" class="btn-primary" wire:loading.attr="disabled">
                            <i class="fas fa-save mr-3" wire:loading.remove></i>
                            <i class="fas fa-spinner fa-spin mr-3" wire:loading></i>
                            {{ $editingProduct ? 'Update Product' : 'Add Product' }}
                        </button>
                    </div>
                </form>
            </div>
    @endif

    <!-- Product Cards Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($products as $product)
            <!-- Product Card -->
            <div class="product-card">
                <div class="card-header">
                    <div class="product-icon">
                        <i class="fas fa-box"></i>
                    </div>
                    <div class="product-badges">
                        @if ($product->featured)
                            <span class="featured-badge">
                                <i class="fas fa-star"></i>
                            </span>
                        @endif
                        @if ($product->status === 'active')
                            <span class="status-badge active">
                                <i class="fas fa-check-circle"></i>
                            </span>
                        @else
                            <span class="status-badge inactive">
                                <i class="fas fa-times-circle"></i>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="card-content">
                    <h3 class="product-title">{{ $product->name }}</h3>
                    <p class="product-slug">{{ $product->slug }}</p>

                    <div class="product-details">
                        <div class="detail-row">
                            <span class="detail-label">Price:</span>
                            <span class="detail-value">{{ $this->formatCurrency($product->price) }}</span>
                        </div>

                        @if ($product->sale_price)
                            <div class="detail-row">
                                <span class="detail-label">Sale:</span>
                                <span
                                    class="detail-value sale-price">{{ $this->formatCurrency($product->sale_price) }}</span>
                            </div>
                        @endif

                        <div class="detail-row">
                            <span class="detail-label">SKU:</span>
                            <span class="detail-value">{{ $product->sku ?? '-' }}</span>
                        </div>

                        <div class="detail-row">
                            <span class="detail-label">Stock:</span>
                            <span class="detail-value">{{ $product->stock }} units</span>
                        </div>

                        <div class="detail-row">
                            <span class="detail-label">Category:</span>
                            <span class="category-badge">{{ $product->category->name ?? '-' }}</span>
                        </div>

                        <div class="detail-row">
                            <span class="detail-label">Vendor:</span>
                            <span class="detail-value">{{ $product->vendor->shop_name ?? '-' }}</span>
                        </div>
                    </div>
                </div>

                <div class="card-actions">
                    <div class="action-buttons">
                        <button wire:click="editProduct({{ $product->id }})" class="action-btn edit"
                            title="Edit">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button wire:click="deleteProduct({{ $product->id }})" class="action-btn delete"
                            title="Delete" onclick="return confirm('Are you sure you want to delete this product?')">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>
            </div>
        @empty
            <!-- Empty State -->
            <div class="empty-state-card">
                <div class="empty-content">
                    <i class="fas fa-box-open"></i>
                    <h3>No products found</h3>
                    <p>Start by adding your first product</p>
                    <button wire:click="showAddProduct" class="btn-primary mt-4">
                        <i class="fas fa-plus mr-2"></i>
                        Add Your First Product
                    </button>
                </div>
            </div>
        @endforelse
    </div>

    @if (session()->has('message'))
        <div class="notification-success">
            <i class="fas fa-check-circle text-xl"></i>
            <span class="font-semibold">{{ session('message') }}</span>
        </div>
    @endif

    @if (session()->has('error'))
        <div class="notification-error">
            <i class="fas fa-exclamation-circle text-xl"></i>
            <span class="font-semibold">{{ session('error') }}</span>
        </div>
    @endif
</div>
