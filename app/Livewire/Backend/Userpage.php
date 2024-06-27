<?php

namespace App\Livewire\Backend;

use Livewire\Component;
use Livewire\Attributes\Layout;

class Userpage extends Component
{
    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.backend.userpage');
    }
}
