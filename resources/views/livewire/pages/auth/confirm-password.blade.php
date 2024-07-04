<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;
use Flasher\Prime\FlasherInterface;

new #[Layout('components.layouts.lockapp')] class extends Component
{
    public string $password = '';

    /**
     * Confirm the current user's password.
     */
    public function confirmPassword(): void
    {
        $this->validate([
            'password' => ['required', 'string'],
        ]);

        if (! Auth::guard('web')->validate([
            'email' => Auth::user()->email,
            'password' => $this->password,
        ])) {
            throw ValidationException::withMessages([
                'password' => __('auth.password'),
            ]);
        }

        session(['auth.password_confirmed_at' => time()]);
        flash()->options(['position' => 'bottom-right'])->success('Password confirmed');
        $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);
    }
    public function cancel():void{
        $this->redirect('dashboard');
    }
}; ?>

<x-slot name="header">
        {{ __('Restricted Access') }}
</x-slot>
<div>
    <div class="row">
        <div class="col-12">
            <x-ui.card title="Restricted Access" submit="confirmPassword" textsubmit="Confirm" btncolor="warning"  class="card-warning card-outline" cancel="cancel" textcancel="Back to dashboard">
                {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
                <x-forms.input name="password" id="password" type="password" icon="bi bi-lock-fill" label="Password"  placeholder="Password" required autocomplete="current-password" />
            </x-ui.card>
        </div>
    </div>
</div>
