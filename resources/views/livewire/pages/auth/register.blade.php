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
    <x-loginlogo />
    <div class="card">
        <form wire:submit="register">
            <div class="card-body register-card-body">
                <p class="register-box-msg">Register a new membership</p>
                <div class="input-group mb-3"> <input type="text" class="form-control  @error('name') is-invalid @enderror" placeholder="Full Name" wire:model="name" id="name" name="name" required autofocus autocomplete="name">
                    <div class="input-group-text"> <span class="bi bi-person"></span> </div>
                    @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="input-group mb-3"> <input type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" wire:model="email" id="email" name="email" required autocomplete="username">
                    <div class="input-group-text"> <span class="bi bi-envelope"></span> </div>
                    @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="input-group mb-3"> <input type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" wire:model="password" id="password" name="password" required autocomplete="new-password">
                    <div class="input-group-text"> <span class="bi bi-lock-fill"></span> </div>
                    @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="input-group mb-3"> <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="Confirm Password" wire:model="password_confirmation" id="password_confirmation" name="password_confirmation" required autocomplete="new-password">
                    <div class="input-group-text"> <span class="bi bi-lock-fill"></span> </div>
                    @error('password_confirmation')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div> <!--begin::Row-->
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
