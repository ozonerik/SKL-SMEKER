<?php

namespace App\Livewire\Pages\Frontend;

use Livewire\Component;
use Livewire\Attributes\Layout;

class Home extends Component
{
    #[Layout('components.layouts.home')]
    public function render()
    {
        return view('livewire.pages.frontend.home');
    }
}
