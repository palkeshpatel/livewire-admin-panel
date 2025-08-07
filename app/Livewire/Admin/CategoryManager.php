<?php

namespace App\Livewire\Admin;

use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Str;

class CategoryManager extends Component
{
    use WithPagination;

    public $search = '';
    public $showAddForm = false;
    public $editingCategory = null;
    public $name = '';
    public $slug = '';
    public $description = '';
    public $status = 'active';

    protected $rules = [
        'name' => 'required|min:3|max:255',
        'slug' => 'required|unique:categories,slug',
        'description' => 'nullable|max:500',
        'status' => 'required|in:active,inactive',
    ];

    public function mount()
    {
        $this->loadCategories();
    }

    public function updatedName()
    {
        if (!$this->editingCategory) {
            $this->slug = Str::slug($this->name);
        }
    }

    public function loadCategories()
    {
        $query = Category::query();
        if ($this->search) {
            $query->where('name', 'like', '%' . $this->search . '%');
        }
        return $query->orderBy('created_at', 'desc')->paginate(10);
    }

    public function showAddCategory()
    {
        $this->resetForm();
        $this->showAddForm = true;
        // Debug: Log to browser console
        $this->dispatch('console-log', message: 'showAddCategory called!');
    }

    public function testMethod()
    {
        $this->dispatch('console-log', message: 'testMethod called!');
    }

    public function editCategory($categoryId)
    {
        $category = Category::findOrFail($categoryId);
        $this->editingCategory = $category;
        $this->name = $category->name;
        $this->slug = $category->slug;
        $this->description = $category->description;
        $this->status = $category->status;
        $this->showAddForm = true;
    }

    public function saveCategory()
    {
        if ($this->editingCategory) {
            $this->rules['slug'] = 'required|unique:categories,slug,' . $this->editingCategory->id;
        }
        $this->validate();

        $data = [
            'name' => $this->name,
            'slug' => $this->slug,
            'description' => $this->description,
            'status' => $this->status,
        ];

        if ($this->editingCategory) {
            $this->editingCategory->update($data);
            session()->flash('message', 'Category updated successfully!');
        } else {
            Category::create($data);
            session()->flash('message', 'Category added successfully!');
        }

        $this->resetForm();
        $this->showAddForm = false;
    }

    public function deleteCategory($categoryId)
    {
        $category = Category::findOrFail($categoryId);
        $category->delete();
        session()->flash('message', 'Category deleted successfully!');
    }

    public function resetForm()
    {
        $this->editingCategory = null;
        $this->name = '';
        $this->slug = '';
        $this->description = '';
        $this->status = 'active';
    }

    public function cancelEdit()
    {
        $this->resetForm();
        $this->showAddForm = false;
    }

    public function render()
    {
        $categories = $this->loadCategories();
        return view('livewire.admin.category-manager', compact('categories'));
    }
}
