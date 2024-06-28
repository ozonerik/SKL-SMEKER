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

<div class="card mb-5">
    <div class="card-header">
        <h3 class="card-title">{{ __('Profile Information') }}</h3>
        <div class="card-tools"> <button type="button" class="btn btn-tool" data-lte-toggle="card-collapse" title="Collapse"> <i data-lte-icon="expand" class="bi bi-plus-lg"></i> <i data-lte-icon="collapse" class="bi bi-dash-lg"></i> </button> <button type="button" class="btn btn-tool" data-lte-toggle="card-remove" title="Remove"> <i class="bi bi-x-lg"></i> </button> </div>
    </div>
    <form wire:submit="updateProfileInformation">
        <div class="card-body">
            <x-forms.input name="name" icon="bi bi-person" label="Full Name"  placeholder="Full Name" required autofocus autocomplete="name" />
            <x-forms.input name="email" type="email" icon="bi bi-envelope" label="Email address"  placeholder="Email" required autocomplete="username" />
            @if (auth()->user() instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! auth()->user()->hasVerifiedEmail())
            <div class="row mb-3">
                <div class="col-12">
                    <div class="callout callout-info">
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
                    </div>
                </div>
            </div>
            @endif
            <div class="row">
                <div class="col-12">
                    <div class="float-end"> <button type="submit" class="btn btn-primary">{{ __('Save') }}</button> </div>
                </div> <!-- /.col -->
            </div> <!--end::Row-->
        </div> <!-- /.card-body -->
    </form>
    <div class="card-footer">
        {{ __("Update your account's profile information and email address.") }}
    </div> <!-- /.card-footer-->
</div> <!-- /.card -->