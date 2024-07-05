<?php

namespace App\Livewire\Pages\Backend;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Spatie\Permission\Models\Role;
use Livewire\WithFileUploads;
use Intervention\Image\Laravel\Facades\Image;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

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
        
        dd($this->only(['initext','iniradio','inicheck','iniselect','inifile']));
        //$this->inifile->store('compress','public');
        //$path=StoreFile($this->inifile,'compress');
        return redirect()->route('dashboard');
    }

    public function mount(){
        $this->initext='ada';
        $this->iniradio='radio2';
        $this->inicheck=true;
        $this->iniselect='operator';
    }
    
    #[Layout('components.layouts.app')]
    public function render()
    {
        $roles=Role::all();
        $data=[
            'roles'=>$roles,
            'user'=>User::get()
        ];
        return view('livewire.pages.backend.dashboardpage',$data);
    }
}
