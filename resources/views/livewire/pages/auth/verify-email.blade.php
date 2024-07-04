<?php

use App\Livewire\Actions\Logout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('components.layouts.lockapp')] class extends Component
{
    /**
     * Send an email verification notification to the user.
     */
    public function sendVerification(): void
    {
        if (Auth::user()->hasVerifiedEmail()) {
            $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);

            return;
        }

        Auth::user()->sendEmailVerificationNotification();

        Session::flash('status', 'verification-link-sent');
    }

    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/', navigate: true);
    }
}; ?>

<x-slot name="header">
        {{ __('Verification Email') }}
</x-slot>
<div>
    @if (session('status') == 'verification-link-sent')
    <x-ui.callout type="info">
        {{ __('A new verification link has been sent to the email address you provided during registration.') }}
    </x-ui.callout>
    @endif
    <div class="row">
        <div class="col-12">
            <x-ui.card title="Verification Email" button="sendVerification" textbutton="Resend Verification Email">
                {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
            </x-ui.card>
        </div>
    </div>
</div>