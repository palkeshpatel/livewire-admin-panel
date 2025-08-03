<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Hash;

class Users extends Component
{
    use WithPagination;

    public $search = '';
    public $showModal = false;
    public $editingUser = null;
    public $name = '';
    public $email = '';
    public $password = '';
    public $password_confirmation = '';

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'password' => 'required|min:8|confirmed',
    ];

    // Debounce search to improve performance
    protected $updatesQueryString = ['search'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function createUser()
    {
        $this->resetForm();
        $this->showModal = true;
        $this->editingUser = null;
    }

    public function editUser($userId)
    {
        $user = User::findOrFail($userId);
        $this->editingUser = $user;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->password = '';
        $this->password_confirmation = '';
        $this->showModal = true;
    }

    public function saveUser()
    {
        if ($this->editingUser) {
            $this->rules['email'] = 'required|email|max:255|unique:users,email,' . $this->editingUser->id;
            $this->rules['password'] = 'nullable|min:8|confirmed';
        }

        $this->validate();

        if ($this->editingUser) {
            $this->editingUser->update([
                'name' => $this->name,
                'email' => $this->email,
            ]);

            if ($this->password) {
                $this->editingUser->update([
                    'password' => Hash::make($this->password)
                ]);
            }

            session()->flash('message', 'User updated successfully!');
        } else {
            User::create([
                'name' => $this->name,
                'email' => $this->email,
                'password' => Hash::make($this->password),
            ]);

            session()->flash('message', 'User created successfully!');
        }

        $this->closeModal();
    }

    public function deleteUser($userId)
    {
        $user = User::findOrFail($userId);
        $user->delete();
        session()->flash('message', 'User deleted successfully!');
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->resetForm();
    }

    private function resetForm()
    {
        $this->name = '';
        $this->email = '';
        $this->password = '';
        $this->password_confirmation = '';
        $this->editingUser = null;
    }

    public function render()
    {
        $users = User::query()
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('name', 'like', '%' . $this->search . '%')
                      ->orWhere('email', 'like', '%' . $this->search . '%');
                });
            })
            ->latest()
            ->paginate(10);

        return view('livewire.admin.users', compact('users'));
    }
} 