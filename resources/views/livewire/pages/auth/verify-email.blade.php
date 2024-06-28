<?php

use App\Livewire\Actions\Logout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.app')] class extends Component
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
    <div class="row mb-3">
        <div class="col-12">
            <div class="callout callout-info">
                {{ __('A new verification link has been sent to the email address you provided during registration.') }}
            </div>
        </div> 
    </div>
    @endif
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Verification Email</h3>
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
                <div class="card-body">
                {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
                </div> <!-- /.card-body -->
                <div class="card-footer">
                    <button type="button" wire:click="sendVerification" class="btn btn-success">{{ __('Resend Verification Email') }}</button> 
                </div> <!-- /.card-footer-->
            </div> <!-- /.card -->
        </div>
    </div>
</div>