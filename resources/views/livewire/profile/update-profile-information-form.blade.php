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
    <div class="card-body">
        <form wire:submit="updateProfileInformation">
            <div class="mb-3">
                <label for="name" class="form-label">Full Name</label>
                <div class="input-group">
                    <input type="text" wire:model="name" id="name" class="form-control @error('name') is-invalid @enderror" placeholder="Full Name" required autofocus autocomplete="name">
                    <div class="input-group-text"> <span class="bi bi-person"></span> </div>
                </div>
                @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="input-group mb-3"> 
                <label for="email" class="form-label">Email address</label>
                <div class="input-group">
                    <input type="email" wire:model="email" id="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" required autocomplete="username">
                    <div class="input-group-text"> <span class="bi bi-envelope"></span> </div>
                </div>
                @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div> <!--begin::Row-->
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
        {{ __("Update your account's profile information and email address.") }}
    </div> <!-- /.card-footer-->
</div> <!-- /.card -->