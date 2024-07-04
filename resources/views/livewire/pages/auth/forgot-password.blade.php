<?php

use Illuminate\Support\Facades\Password;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;
use Flasher\Prime\FlasherInterface;

new #[Layout('components.layouts.guest')] class extends Component
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
            flash()->options(['position' => 'bottom-right'])->error('Password reset link failed sent');
            return;
        }

        $this->reset('email');
        flash()->options(['position' => 'bottom-right'])->success('Password reset link sent');
        session()->flash('status', __($status));
    }
}; ?>

<div class="login-box">
    <x-ui.loginlogo />
    <div class="card">
        <form wire:submit="sendPasswordResetLink">
            <div class="card-body login-card-body">
                <div class="mb-4 text-justify">
                        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
                </div>
                <!-- Session Status -->
                <x-ui.auth-session-status :status="session('status')" />
                <x-forms.input name="email" icon="bi bi-envelope" placeholder="Email" required autofocus />
                <div class="row">
                    <div class="col-12">
                        <div class="d-grid gap-2"> <button type="submit" class="btn btn-primary">{{ __('Email Password Reset Link') }}</button> </div>
                    </div> <!-- /.col -->
                </div> <!--end::Row-->
                @if (Route::has('login'))
                <p class="mb-0 mt-1 text-center"> 
                    <a href="{{ route('login') }}" class="link-offset-1 " wire:navigate>
                        Log in
                    </a> 
                </p>
                @endif
            </div> <!-- /.login-card-body -->
        </form>
    </div>
</div> <!-- /.login-box --> <!--begin::Third Party Plugin(OverlayScrollbars)-->
