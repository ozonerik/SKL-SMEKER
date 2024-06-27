<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public string $password = '';

    /**
     * Confirm the current user's password.
     */
    public function confirmPassword(): void
    {
        $this->validate([
            'password' => ['required', 'string'],
        ]);

        if (! Auth::guard('web')->validate([
            'email' => Auth::user()->email,
            'password' => $this->password,
        ])) {
            throw ValidationException::withMessages([
                'password' => __('auth.password'),
            ]);
        }

        session(['auth.password_confirmed_at' => time()]);

        $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);
    }
}; ?>

<div class="login-box">
    <div class="login-logo"> <a href="{{ url('/') }}" wire:navigate><b>Admin</b>LTE</a> </div> <!-- /.login-logo -->
    <div class="card">
        <div class="card-body login-card-body">
            <div class="mb-4 text-justify">
            {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
            </div>
            <form wire:submit="confirmPassword">
                <div class="input-group mb-3"> <input type="password" wire:model="password" id="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" required autocomplete="current-password">
                    <div class="input-group-text"> <span class="bi bi-envelope"></span> </div>
                    @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="d-grid gap-2"> <button type="submit" class="btn btn-primary">{{ __('Confirm') }}</button> </div>
                    </div> <!-- /.col -->
                </div> <!--end::Row-->
            </form>
        </div> <!-- /.login-card-body -->
    </div>
</div> <!-- /.login-box --> <!--begin::Third Party Plugin(OverlayScrollbars)-->
