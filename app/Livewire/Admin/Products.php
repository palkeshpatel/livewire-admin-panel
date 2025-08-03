<?php

namespace App\Livewire\Admin;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class Products extends Component
{
    use WithPagination, WithFileUploads;

    public $search = '';
    public $showModal = false;
    public $editingProduct = null;
    public $name = '';
    public $description = '';
    public $price = '';
    public $stock = '';
    public $status = 'active';
    public $image;

    protected $rules = [
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'price' => 'required|numeric|min:0',
        'stock' => 'required|integer|min:0',
        'status' => 'required|in:active,inactive',
        'image' => 'nullable|image|max:1024',
    ];

    // Debounce search to improve performance
    protected $updatesQueryString = ['search'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function createProduct()
    {
        $this->resetForm();
        $this->showModal = true;
        $this->editingProduct = null;
    }

    public function editProduct($productId)
    {
        $product = Product::findOrFail($productId);
        $this->editingProduct = $product;
        $this->name = $product->name;
        $this->description = $product->description;
        $this->price = $product->price;
        $this->stock = $product->stock;
        $this->status = $product->status;
        $this->image = null;
        $this->showModal = true;
    }

    public function saveProduct()
    {
        if ($this->editingProduct) {
            $this->rules['name'] = 'required|string|max:255|unique:products,name,' . $this->editingProduct->id;
        }

        $this->validate();

        $data = [
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'stock' => $this->stock,
            'status' => $this->status,
        ];

        if ($this->image) {
            // Delete old image if exists
            if ($this->editingProduct && $this->editingProduct->image) {
                Storage::disk('public')->delete($this->editingProduct->image);
            }
            $data['image'] = $this->image->store('products', 'public');
        }

        if ($this->editingProduct) {
            $this->editingProduct->update($data);
            session()->flash('message', 'Product updated successfully!');
        } else {
            Product::create($data);
            session()->flash('message', 'Product created successfully!');
        }

        $this->closeModal();
    }

    public function deleteProduct($productId)
    {
        $product = Product::findOrFail($productId);

        // Delete image if exists
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();
        session()->flash('message', 'Product deleted successfully!');
    }

    public function toggleStatus($productId)
    {
        $product = Product::findOrFail($productId);
        $product->update([
            'status' => $product->status === 'active' ? 'inactive' : 'active'
        ]);
        session()->flash('message', 'Product status updated!');
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->resetForm();
    }

    private function resetForm()
    {
        $this->name = '';
        $this->description = '';
        $this->price = '';
        $this->stock = '';
        $this->status = 'active';
        $this->image = null;
        $this->editingProduct = null;
    }

    public function render()
    {
        $products = Product::query()
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('name', 'like', '%' . $this->search . '%')
                        ->orWhere('description', 'like', '%' . $this->search . '%');
                });
            })
            ->latest()
            ->paginate(10);

        return view('livewire.admin.products', compact('products'));
    }
}
