<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.applock')] class extends Component
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

<x-slot name="header">
        {{ __('Restricted Access') }}
</x-slot>
<div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Restricted Access</h3>
                    <div class="card-tools"> 
                        <button type="button" class="btn btn-tool" data-lte-toggle="card-collapse" title="Collapse"> 
                            <i data-lte-icon="expand" class="bi bi-plus-lg"></i> 
                            <i data-lte-icon="collapse" class="bi bi-dash-lg"></i> 
                        </button> 
                        <button type="button" class="btn btn-tool" data-lte-toggle="card-remove" title="Remove"> 
                            <i class="bi bi-x-lg"></i> 
                        </button> 
                    </div>
                </div>
                <form wire:submit="confirmPassword">
                    <div class="card-body">
                        {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
                        <div class="input-group"> 
                            <input type="password" wire:model="password" id="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" required autocomplete="current-password">
                            <div class="input-group-text"> <span class="bi bi-lock-fill"></span> </div>
                            @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div> <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit"class="btn btn-success">{{ __('Confirm') }}</button> 
                    </div> <!-- /.card-footer-->
                </form>
            </div> <!-- /.card -->
        </div>
    </div>
</div>
