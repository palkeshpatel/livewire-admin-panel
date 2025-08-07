<?php

namespace App\Livewire\Admin;

use Livewire\Component;

class UltraSimpleTest extends Component
{
    public $count = 0;
    public $message = '';

    public function increment()
    {
        $this->count++;
        $this->message = "Count incremented to: " . $this->count;
    }

    public function render()
    {
        return view('livewire.admin.ultra-simple-test');
    }
} 