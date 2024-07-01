<?php

namespace App\Livewire\Backend;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Spatie\Permission\Models\Role;

class Dashboardpage extends Component
{
    public $initext;
    public $iniradio;
    public $inicheck;
    public $iniselect;

 
    public function save()
    {
        dd($this->only(['initext','iniradio','inicheck','iniselect']));
    }
    
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
