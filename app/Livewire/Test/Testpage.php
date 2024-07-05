<?php

namespace App\Livewire\Test;

use Livewire\Component;
use Livewire\Attributes\Layout;

class Testpage extends Component
{
    #[Layout('components.layouts.clear')]
    public function render()
    {
        return view('livewire.test.testpage');
    }
}
