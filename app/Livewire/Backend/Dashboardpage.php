<?php

namespace App\Livewire\Backend;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Spatie\Permission\Models\Role;

class Dashboardpage extends Component
{
    #[Layout('layouts.app')]
    public function render()
    {
        $roles=Role::all();
        $data=[
            'roles'=>$roles,
        ];
        return view('livewire.backend.dashboardpage',$data);
    }
}
