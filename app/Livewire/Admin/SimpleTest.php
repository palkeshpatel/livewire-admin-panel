<?php

namespace App\Livewire\Admin;

use Livewire\Component;

class SimpleTest extends Component
{
    public $message = 'Hello from Livewire!';
    public $showModal = false;
    public $name = '';

    public function toggleModal()
    {
        $this->showModal = !$this->showModal;
    }

    public function updateName()
    {
        $this->name = 'Updated at ' . now();
    }

    public function render()
    {
        return view('livewire.admin.simple-test');
    }
} 