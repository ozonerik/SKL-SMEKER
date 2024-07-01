<?php

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';

    /**
     * Handle an incoming registration request.
     */
    public function register(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        event(new Registered($user = User::create($validated)));

        Auth::login($user);

        $this->redirect(route('dashboard', absolute: false), navigate: true);
    }
}; ?>

<div class="register-box">
    <x-ui.loginlogo />
    <div class="card">
        <form wire:submit="register">
            <div class="card-body register-card-body">
                <p class="register-box-msg">Register a new membership</p>
                <x-forms.input name="name" icon="bi bi-person" placeholder="Full Name" required autofocus autocomplete="name" />
                <x-forms.input name="email" icon="bi bi-envelope" placeholder="Email" required autocomplete="username" />
                <x-forms.input name="password" type="password" icon="bi bi-lock-fill" placeholder="Password" required autocomplete="new-password" />
                <x-forms.input name="password_confirmation" type="password" icon="bi bi-lock-fill" placeholder="Confirm Password" required autocomplete="new-password" />
                <div class="row">
                    <div class="col-12">
                        <div class="d-grid gap-2"> <button type="submit" class="btn btn-primary">Register</button> </div>
                    </div> <!-- /.col -->
                </div> <!--end::Row-->
                @if (Route::has('login'))
                <p class="mb-0 mt-1"> 
                    <a href="{{ route('login') }}" class="link-offset-1 text-center" wire:navigate>
                        I already have a membership
                    </a> 
                </p>
                @endif
            </div> <!-- /.register-card-body -->
        </form>
    </div>
</div> <!-- /.register-box --> <!--begin::Third Party Plugin(OverlayScrollbars)-->
