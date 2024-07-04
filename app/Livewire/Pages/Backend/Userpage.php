<?php

namespace App\Livewire\Pages\Backend;

use Livewire\Component;
use Livewire\Attributes\Layout;

class Userpage extends Component
{
    #[Layout('components.layouts.app')]
    public function render()
    {
        return view('livewire.pages.backend.userpage');
    }
}
