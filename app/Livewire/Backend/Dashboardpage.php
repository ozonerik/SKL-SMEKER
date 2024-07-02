<?php

namespace App\Livewire\Backend;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Spatie\Permission\Models\Role;
use Livewire\WithFileUploads;
use Intervention\Image\Laravel\Facades\Image;
use Illuminate\Support\Facades\Storage;

class Dashboardpage extends Component
{
    use WithFileUploads;

    public $initext;
    public $iniradio;
    public $inicheck;
    public $iniselect;
    public $inifile;

 
    public function save()
    {
        
        //dd($this->only(['initext','iniradio','inicheck','iniselect','inifile']));
        //$this->inifile->store('compress','public');
        $path=StoreFile($this->inifile,'compress');
        return redirect()->route('dashboard');
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
