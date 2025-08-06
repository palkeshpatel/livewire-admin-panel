<?php

namespace App\Livewire\Admin;

use App\Models\Product;
use App\Models\Category;
use App\Models\Vendor;
use App\Helpers\CurrencyHelper;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Str;


class ProductManager extends Component
{
    use WithPagination;

    public $search = '';
    public $selectedCategory = '';
    public $selectedVendor = '';
    public $showAddForm = false;

    public $editingProduct = null;
    public $expandedProducts = [];

    // Form fields
    public $name = '';
    public $slug = '';
    public $description = '';
    public $price = '';
    public $sale_price = '';
    public $stock = '';
    public $sku = '';
    public $category_id = '';
    public $vendor_id = '';
    public $status = 'active';
    public $featured = 0;

    protected $rules = [
        'name' => 'required|min:3|max:255',
        'slug' => 'required|unique:products,slug',
        'price' => 'required|numeric|min:0',
        'sale_price' => 'nullable|numeric|min:0|lte:price',
        'stock' => 'required|integer|min:0',
        'sku' => 'nullable|string|max:100|unique:products,sku',
        'category_id' => 'required|exists:categories,id',
        'vendor_id' => 'required|exists:vendors,id',
        'status' => 'required|in:active,inactive',
        'featured' => 'required|in:0,1',
    ];

    protected $messages = [
        'name.required' => 'Product name is required.',
        'name.min' => 'Product name must be at least 3 characters.',
        'slug.required' => 'Product slug is required.',
        'slug.unique' => 'This slug is already taken.',
        'price.required' => 'Product price is required.',
        'price.numeric' => 'Price must be a valid number.',
        'price.min' => 'Price must be greater than 0.',
        'sale_price.numeric' => 'Sale price must be a valid number.',
        'sale_price.min' => 'Sale price must be greater than 0.',
        'sale_price.lte' => 'Sale price must be less than or equal to regular price.',
        'stock.required' => 'Stock quantity is required.',
        'stock.integer' => 'Stock must be a whole number.',
        'stock.min' => 'Stock must be 0 or greater.',
        'sku.unique' => 'This SKU is already taken.',
        'category_id.required' => 'Please select a category.',
        'vendor_id.required' => 'Please select a vendor.',
    ];

    public function mount()
    {
        $this->loadProducts();
    }

    public function updatedName()
    {
        if (!$this->editingProduct) {
            $this->slug = Str::slug($this->name);
        }
    }

    public function loadProducts()
    {
        $query = Product::with(['category', 'vendor']);

        if ($this->search) {
            $query->where(function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('slug', 'like', '%' . $this->search . '%')
                    ->orWhere('sku', 'like', '%' . $this->search . '%')
                    ->orWhereHas('category', function ($categoryQuery) {
                        $categoryQuery->where('name', 'like', '%' . $this->search . '%');
                    })
                    ->orWhereHas('vendor', function ($vendorQuery) {
                        $vendorQuery->where('shop_name', 'like', '%' . $this->search . '%');
                    });
            });
        }

        if ($this->selectedCategory) {
            $query->where('category_id', $this->selectedCategory);
        }

        if ($this->selectedVendor) {
            $query->where('vendor_id', $this->selectedVendor);
        }

        return $query->orderBy('created_at', 'desc')->paginate(10);
    }

    public function showAddProduct()
    {
        $this->resetForm();
        $this->showAddForm = true;
        // Debug: Log to browser console
        $this->dispatch('console-log', message: 'showAddProduct method called!');
    }

    public function editProduct($productId)
    {
        $product = Product::findOrFail($productId);
        $this->editingProduct = $product;
        $this->name = $product->name;
        $this->slug = $product->slug;
        $this->description = $product->description;
        $this->price = $product->price;
        $this->sale_price = $product->sale_price;
        $this->stock = $product->stock;
        $this->sku = $product->sku;
        $this->category_id = $product->category_id;
        $this->vendor_id = $product->vendor_id;
        $this->status = $product->status;
        $this->featured = $product->featured;
        $this->showAddForm = true;
    }

    public function saveProduct()
    {
        // Update validation rules for editing
        if ($this->editingProduct) {
            $this->rules['slug'] = 'required|unique:products,slug,' . $this->editingProduct->id;
            if ($this->sku) {
                $this->rules['sku'] = 'nullable|string|max:100|unique:products,sku,' . $this->editingProduct->id;
            }
        } else {
            if ($this->sku) {
                $this->rules['sku'] = 'nullable|string|max:100|unique:products,sku';
            }
        }

        $this->validate();

        $data = [
            'name' => $this->name,
            'slug' => $this->slug,
            'description' => $this->description,
            'price' => $this->price,
            'sale_price' => $this->sale_price ?: null,
            'stock' => $this->stock,
            'sku' => $this->sku ?: null,
            'category_id' => $this->category_id,
            'vendor_id' => $this->vendor_id,
            'status' => $this->status,
            'featured' => $this->featured,
        ];

        try {
            if ($this->editingProduct) {
                $this->editingProduct->update($data);
                session()->flash('message', 'Product updated successfully!');
            } else {
                Product::create($data);
                session()->flash('message', 'Product added successfully!');
            }

            $this->resetForm();
            $this->showAddForm = false;
        } catch (\Exception $e) {
            session()->flash('error', 'An error occurred while saving the product. Please try again.');
        }
    }

    public function deleteProduct($productId)
    {
        $product = Product::findOrFail($productId);
        $product->delete();
        session()->flash('message', 'Product deleted successfully!');
    }

    public function resetForm()
    {
        $this->editingProduct = null;
        $this->name = '';
        $this->slug = '';
        $this->description = '';
        $this->price = '';
        $this->sale_price = '';
        $this->stock = '';
        $this->sku = '';
        $this->category_id = '';
        $this->vendor_id = '';
        $this->status = 'active';
        $this->featured = 0;
    }

    public function cancelEdit()
    {
        $this->resetForm();
        $this->showAddForm = false;
    }

    public function toggleDetails($productId)
    {
        if (in_array($productId, $this->expandedProducts)) {
            $this->expandedProducts = array_diff($this->expandedProducts, [$productId]);
        } else {
            $this->expandedProducts[] = $productId;
        }
    }

    public function formatCurrency($amount)
    {
        return CurrencyHelper::format($amount);
    }

    public function render()
    {
        $products = $this->loadProducts();
        $categories = Category::all();
        $vendors = Vendor::all();

        return view('livewire.admin.product-manager', compact('products', 'categories', 'vendors'));
    }
}
