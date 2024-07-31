<?php

namespace App\Livewire\Pages\Backend;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Spatie\Permission\Models\Role;
use Livewire\WithFileUploads;
use Intervention\Image\Laravel\Facades\Image;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use Livewire\Attributes\On;
use App\Imports\UsersImport;
use Maatwebsite\Excel\Facades\Excel;
use Flasher\Prime\FlasherInterface;

class Dashboardpage extends Component
{
    use WithFileUploads;

    public $initext;
    public $iniradio;
    public $inicheck;
    public $iniselect;
    public $inifile;
    public $userfile;
    public $inidatatable=[];

 
    public function save()
    {
        //dd($this->only(['initext','iniradio','inicheck','iniselect','inifile']));
        //$this->inifile->store('compress','public');
        //$path=StoreFile($this->inifile,'compress');
        return redirect()->route('dashboard');
    }

    public function onDelSel()
    {
        dd('Ini Delete Selection');
    }

    public function onImport()
    {
        $this->dispatch('upload-user');
    }

    public function ImportUser()
    {
        Excel::import(new UsersImport, $this->userfile);
        flash()->options(['position' => 'bottom-right'])->success('User added');
        $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);
    }

    public function onEdit($id)
    {
        dd('edit-'.$id);
    }

    public function onDelete($id)
    {
        //dd('delete-'.$id);
        User::findOrFail($id)->delete();
        flash()->options(['position' => 'bottom-right'])->success('User deleted');
        $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);
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
