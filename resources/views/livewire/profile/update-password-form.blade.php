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

<x-ui.card title="Update Password"  submit="updatePassword" textsubmit="Save" btncolor="primary" class="card-primary card-outline">
    <div class="row mb-3">
        <div class="col-12">
        {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </div>
    </div>
    <x-forms.input name="current_password" type="password" icon="bi bi-lock-fill" label="Current Password"  placeholder="Current Password" required autocomplete="current-password" />
    <x-forms.input name="password" id="update-password" type="password" icon="bi bi-lock-fill" label="New Password"  placeholder="New Password" required autocomplete="new-password" />
    <x-forms.input name="password_confirmation" type="password" icon="bi bi-lock-fill" label="Confirm Password"  placeholder="Confirm Password" required autocomplete="new-password" />
</x-ui.card>
