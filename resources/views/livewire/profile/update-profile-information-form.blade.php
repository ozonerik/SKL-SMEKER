<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Livewire\Volt\Component;

new class extends Component
{
    public string $name = '';
    public string $email = '';

    /**
     * Mount the component.
     */
    public function mount(): void
    {
        $this->name = Auth::user()->name;
        $this->email = Auth::user()->email;
    }

    /**
     * Update the profile information for the currently authenticated user.
     */
    public function updateProfileInformation(): void
    {
        $user = Auth::user();

        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($user->id)],
        ]);

        $user->fill($validated);

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        $this->dispatch('profile-updated', name: $user->name);
    }

    /**
     * Send an email verification notification to the current user.
     */
    public function sendVerification(): void
    {
        $user = Auth::user();

        if ($user->hasVerifiedEmail()) {
            $this->redirectIntended(default: route('dashboard', absolute: false));

            return;
        }

        $user->sendEmailVerificationNotification();

        Session::flash('status', 'verification-link-sent');
    }
}; ?>

<x-ui.card title="Profile Information"  submit="updateProfileInformation" textsubmit="Save" btncolor="primary" class="card-primary card-outline">
    <div class="row mb-3">
        <div class="col-12">
        {{ __("Update your account's profile information and email address.") }}
        </div>
    </div>
    <x-forms.input name="name" icon="bi bi-person" label="Full Name"  placeholder="Full Name" required autofocus autocomplete="name" />
    <x-forms.input name="email" type="email" icon="bi bi-envelope" label="Email address"  placeholder="Email" required autocomplete="username" />
    @if (auth()->user() instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! auth()->user()->hasVerifiedEmail())
    <x-ui.callout type="info">
        <p>
            {{ __('Your email address is unverified.') }}
            <button wire:click.prevent="sendVerification" class="btn btn-link link-offset-1">
            {{ __('Click here to re-send the verification email.') }}
            </button>
        </p>
        @if (session('status') === 'verification-link-sent')
            <p class="mt-2">
                {{ __('A new verification link has been sent to your email address.') }}
            </p>
        @endif
    </x-ui.callout>
    @endif
</x-ui.card>