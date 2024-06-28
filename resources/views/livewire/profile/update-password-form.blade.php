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
    <form wire:submit="updatePassword">
        <div class="card-body">
            <x-forms.input name="current_password" type="password" icon="bi bi-lock-fill" label="Current Password"  placeholder="Current Password" required autocomplete="current-password" />
            <x-forms.input name="password" type="password" icon="bi bi-lock-fill" label="New Password"  placeholder="New Password" required autocomplete="new-password" />
            <x-forms.input name="password_confirmation" type="password" icon="bi bi-lock-fill" label="Confirm Password"  placeholder="Confirm Password" required autocomplete="new-password" />
            <div class="row">
                <div class="col-12">
                    <div class="float-end"> <button type="submit" class="btn btn-primary">{{ __('Save') }}</button> </div>
                </div> <!-- /.col -->
            </div> <!--end::Row-->
        </div> <!-- /.card-body -->
    </form>
    <div class="card-footer">
        {{ __('Ensure your account is using a long, random password to stay secure.') }}
    </div> <!-- /.card-footer-->
</div> <!-- /.card -->
