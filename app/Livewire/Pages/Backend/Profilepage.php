<?php

namespace App\Livewire\Pages\Backend;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Livewire\Actions\Logout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Flasher\Prime\FlasherInterface;
use Spatie\Permission\Models\Role;
use Livewire\WithFileUploads;
use Intervention\Image\Laravel\Facades\Image;
use Illuminate\Support\Facades\Storage;

class Profilepage extends Component
{
    use WithFileUploads;

    public string $name = '';
    public string $email = '';
    public string $current_password = '';
    public string $newpassword = '';
    public string $password_confirmation = '';
    public string $password = '';
    public $role,$photo;
    private $oldphoto;

    public function reseterror()
    {
        $this->resetValidation();
    }
    
    /**
     * Mount the component.
     */
    public function mount()
    {
        $this->name = Auth::user()->name;
        $this->email = Auth::user()->email;
        $this->role = Auth::user()->getRoleNames()->first();
    }

    /**
     * Update the profile information for the currently authenticated user.
     */
    public function updateProfileInformation()
    {
        $user = Auth::user();
        $this->oldphoto = Auth::user()->photo;

        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($user->id)],
            'role' => ['required'],
            'photo' => ['nullable','image'],
        ]);

        $user->fill($validated);

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->photo=StoreFile($this->photo,'photos',$this->oldphoto);
        $user->save();
        $user->syncRoles([$this->role]);
        $this->photo=null;

        $this->dispatch('profile-updated', name: $user->name);
        flash()->options(['position' => 'bottom-right'])->success('Profile updated');
        $this->redirectIntended(default: route('profile', absolute: false), navigate: true);
    }

    /**
     * Send an email verification notification to the current user.
     */
    public function sendVerification()
    {
        $user = Auth::user();

        if ($user->hasVerifiedEmail()) {
            $this->redirectIntended(default: route('dashboard', absolute: false));

            return;
        }

        $user->sendEmailVerificationNotification();

        Session::flash('status', 'verification-link-sent');
        flash()->options(['position' => 'bottom-right'])->success('Verification link sent');
    }

    /**
     * Update the password for the currently authenticated user.
     */
    public function updatePassword()
    {
        try {
            $validated = $this->validate([
                'current_password' => ['required', 'string', 'current_password'],
                'newpassword' => ['required', 'string', Password::defaults(), 'confirmed'],
            ]);
        } catch (ValidationException $e) {
            $this->reset('current_password', 'newpassword', 'password_confirmation');
            flash()->options(['position' => 'bottom-right'])->error('Password updated failed');
            throw $e;
        }

        Auth::user()->update([
            'password' => Hash::make($validated['newpassword']),
        ]);

        $this->reset('current_password', 'newpassword', 'password_confirmation');

        $this->dispatch('password-updated');
        flash()->options(['position' => 'bottom-right'])->success('Password updated');
        
    }

    /**
     * Delete the currently authenticated user.
     */
    public function deleteUser(Logout $logout)
    {
/*         $this->validate([
            'password' => ['required', 'string', 'current_password'],
        ]); */

        try {
            $validated = $this->validate([
                'password' => ['required', 'string', 'current_password'],
            ]);
        } catch (ValidationException $e) {
            $this->reset('password');
            throw $e;
        }

        tap(Auth::user(), $logout(...))->delete();
        flash()->options(['position' => 'bottom-right'])->success('User deleted success');
        $this->redirect('/', navigate: true);
    }

    #[Layout('components.layouts.app')]
    public function render()
    {
        $data=[
            'roles'=>Role::all(),
            'user'=>User::get()
        ];
        return view('livewire.pages.backend.profilepage',$data);
    }
}
