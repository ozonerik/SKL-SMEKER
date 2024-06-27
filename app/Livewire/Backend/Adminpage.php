<?php

namespace App\Livewire\Backend;

use Livewire\Component;
use Livewire\Attributes\Layout;

class Adminpage extends Component
{
    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.backend.adminpage');
    }
}
