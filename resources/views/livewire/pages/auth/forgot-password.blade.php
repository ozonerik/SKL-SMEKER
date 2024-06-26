<?php

use Illuminate\Support\Facades\Password;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public string $email = '';

    /**
     * Send a password reset link to the provided email address.
     */
    public function sendPasswordResetLink(): void
    {
        $this->validate([
            'email' => ['required', 'string', 'email'],
        ]);

        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
        $status = Password::sendResetLink(
            $this->only('email')
        );

        if ($status != Password::RESET_LINK_SENT) {
            $this->addError('email', __($status));

            return;
        }

        $this->reset('email');

        session()->flash('status', __($status));
    }
}; ?>

<div class="login-box">
    <div class="login-logo"> <a href="{{ url('/') }}"><b>Admin</b>LTE</a> </div> <!-- /.login-logo -->
    <div class="card">
        <div class="card-body login-card-body">
            <div class="mb-4 text-justify">
                    {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
            </div>
            <!-- Session Status -->
            <x-auth-session-status :status="session('status')" />
            <form wire:submit="sendPasswordResetLink">
                <div class="input-group mb-3"> <input type="email" wire:model="email" id="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" name="email" required autofocus>
                    <div class="input-group-text"> <span class="bi bi-envelope"></span> </div>
                    @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="d-grid gap-2"> <button type="submit" class="btn btn-primary">{{ __('Email Password Reset Link') }}</button> </div>
                    </div> <!-- /.col -->
                </div> <!--end::Row-->
            </form>
            @if (Route::has('login'))
            <p class="mb-0 text-center"> <a href="{{ route('login') }}" wire:navigate class="link-offset-1 ">
                    Log in
                </a> </p>
            @endif
        </div> <!-- /.login-card-body -->
    </div>
</div> <!-- /.login-box --> <!--begin::Third Party Plugin(OverlayScrollbars)-->
