<div class="fade-in" @console-log.window="console.log($event.detail.message)">
    <!-- Header -->
    <div class="mb-6">
        <h2 class="admin-title">Category Management</h2>
        <p class="admin-subtitle mt-2">Manage your product categories</p>
    </div>

    <!-- Search and Add Category -->
    <div class="admin-card p-4 mb-6">
        <div class="flex items-center gap-4">
            <div class="flex-1 max-w-md">
                <div class="relative">
                    <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                    <input wire:model.live="search" type="text" placeholder="Search categories..."
                        class="form-input pl-10 h-10 text-sm">
                </div>
            </div>
            <button wire:click="showAddCategory" class="btn-primary px-4 py-2 text-sm">
                <i class="fas fa-plus mr-2"></i>
                Add Category
            </button>
            <button onclick="alert('JS works!')" class="btn-secondary px-4 py-2 text-sm ml-2">
                Test JS
            </button>
            <button wire:click="testMethod" class="btn-secondary px-4 py-2 text-sm ml-2">
                Test Livewire
            </button>
        </div>
    </div>

    <!-- Notifications -->
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

    <!-- Categories Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($categories as $category)
            <div class="category-card">
                <div class="card-header">
                    <div class="category-icon">
                        <i class="fas fa-tag"></i>
                    </div>
                    <div class="category-badges">
                        @if ($category->status === 'active')
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
                    <h3 class="category-title">{{ $category->name }}</h3>
                    <p class="category-slug">{{ $category->slug }}</p>
                    <div class="category-details">
                        <div class="detail-row">
                            <span class="detail-label">Description:</span>
                            <span class="detail-value">{{ $category->description ?: 'No description' }}</span>
                        </div>
                        <div class="detail-row">
                            <span class="detail-label">Status:</span>
                            <span class="detail-value">{{ ucfirst($category->status) }}</span>
                        </div>
                        <div class="detail-row">
                            <span class="detail-label">Products:</span>
                            <span class="detail-value">{{ $category->products_count ?? 0 }} products</span>
                        </div>
                    </div>
                </div>
                <div class="card-actions">
                    <div class="action-buttons">
                        <button wire:click="editCategory({{ $category->id }})" class="action-btn edit" title="Edit">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button wire:click="deleteCategory({{ $category->id }})" class="action-btn delete"
                            title="Delete" onclick="return confirm('Are you sure you want to delete this category?')">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>
            </div>
        @empty
            <div class="empty-state-card">
                <div class="empty-content">
                    <i class="fas fa-tags"></i>
                    <h3>No categories found</h3>
                    <p>Start by adding your first category</p>
                    <button wire:click="showAddCategory" class="btn-primary mt-4">
                        <i class="fas fa-plus mr-2"></i>
                        Add Your First Category
                    </button>
                </div>
            </div>
        @endforelse
    </div>

    <!-- Add/Edit Form Modal -->
    @if ($showAddForm)
        <div class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4"
            wire:click="cancelEdit">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-xl w-full max-w-2xl max-h-[90vh] overflow-y-auto"
                wire:click.stop>
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white">
                        {{ $editingCategory ? 'Edit Category' : 'Add New Category' }}
                    </h3>
                    <button wire:click="cancelEdit"
                        class="text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200 transition-colors">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>

                <form wire:submit="saveCategory" class="p-6">
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Category
                                Name *</label>
                            <input wire:model="name" type="text" placeholder="Enter category name"
                                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">
                            @error('name')
                                <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Slug
                                *</label>
                            <input wire:model="slug" type="text" placeholder="category-slug"
                                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">
                            @error('slug')
                                <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label
                                class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Description</label>
                            <textarea wire:model="description" rows="3" placeholder="Enter category description..."
                                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white"></textarea>
                            @error('description')
                                <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label
                                class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Status</label>
                            <select wire:model="status"
                                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white">
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                            @error('status')
                                <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="flex justify-end gap-4 mt-6 pt-6 border-t border-gray-200 dark:border-gray-700">
                        <button type="button" wire:click="cancelEdit"
                            class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white dark:border-gray-600 dark:hover:bg-gray-600">
                            Cancel
                        </button>
                        <button type="submit"
                            class="px-4 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-md shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            <i class="fas fa-save mr-2"></i>
                            {{ $editingCategory ? 'Update Category' : 'Add Category' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>
