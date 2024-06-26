<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;
use Livewire\Volt\Component;

new class extends Component
{
    public string $current_password = '';
    public string $password = '';
    public string $password_confirmation = '';

    /**
     * Update the password for the currently authenticated user.
     */
    public function updatePassword(): void
    {
        try {
            $validated = $this->validate([
                'current_password' => ['required', 'string', 'current_password'],
                'password' => ['required', 'string', Password::defaults(), 'confirmed'],
            ]);
        } catch (ValidationException $e) {
            $this->reset('current_password', 'password', 'password_confirmation');

            throw $e;
        }

        Auth::user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        $this->reset('current_password', 'password', 'password_confirmation');

        $this->dispatch('password-updated');
    }
}; ?>

<div class="card mb-5">
    <div class="card-header">
        <h3 class="card-title">{{ __('Update Password') }}</h3>
        <div class="card-tools"> <button type="button" class="btn btn-tool" data-lte-toggle="card-collapse" title="Collapse"> <i data-lte-icon="expand" class="bi bi-plus-lg"></i> <i data-lte-icon="collapse" class="bi bi-dash-lg"></i> </button> <button type="button" class="btn btn-tool" data-lte-toggle="card-remove" title="Remove"> <i class="bi bi-x-lg"></i> </button> </div>
    </div>
    <div class="card-body">
        <form wire:submit="updatePassword">
            <div class="mb-3"> 
                <label for="update_password_current_password" class="form-label">Current Password</label>
                <div class="input-group">
                    <input type="password" wire:model="current_password" id="update_password_current_password" class="form-control @error('current_password') is-invalid @enderror" placeholder="Current Password" autocomplete="current-password">
                    <div class="input-group-text"> <span class="bi bi-envelope"></span> </div>
                </div>
                @error('current_password')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3"> 
                <label for="update_password_password" class="form-label">New Password</label>
                <div class="input-group">
                    <input type="password" wire:model="password" id="update_password_password" class="form-control @error('password') is-invalid @enderror" placeholder="New Password" autocomplete="new-password">
                    <div class="input-group-text"> <span class="bi bi-lock-fill"></span> </div>
                </div>
                @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3"> 
                <label for="update_password_password_confirmation" class="form-label">Confirm Password</label>
                <div class="input-group">
                    <input type="password" wire:model="password_confirmation" id="update_password_password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="Confirm Password" autocomplete="new-password">
                    <div class="input-group-text"> <span class="bi bi-lock-fill"></span> </div>
                </div>
                @error('password_confirmation')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="row">
                @if (auth()->user() instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! auth()->user()->hasVerifiedEmail())
                    <div class="col-12 alert alert-success alert-dismissible fade show" role="alert">
                        <p class="mt-2">
                            {{ __('Your email address is unverified.') }}
                            <button wire:click.prevent="sendVerification" class="btn btn-success">
                                {{ __('Click here to re-send the verification email.') }}
                            </button>
                        </p>

                        @if (session('status') === 'verification-link-sent')
                            <p class="mt-2">
                                {{ __('A new verification link has been sent to your email address.') }}
                            </p>
                        @endif
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="float-end"> <button type="submit" class="btn btn-primary">{{ __('Save') }}</button> </div>
                </div> <!-- /.col -->
            </div> <!--end::Row-->
        </form>
    </div> <!-- /.card-body -->
    <div class="card-footer">
        {{ __('Ensure your account is using a long, random password to stay secure.') }}
    </div> <!-- /.card-footer-->
</div> <!-- /.card -->
