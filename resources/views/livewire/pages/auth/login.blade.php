<?php

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public LoginForm $form;

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        $this->validate();

        $this->form->authenticate();

        Session::regenerate();

        $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);
    }
}; ?>
<div class="login-box">
    <div class="login-logo"> <a href="{{ url('/') }}"><b>Admin</b>LTE</a> </div> <!-- /.login-logo -->
    <div class="card">
        <div class="card-body login-card-body">
            <x-auth-session-status :status="session('status')" />
            <p class="login-box-msg">Sign in to start your session</p>
            <form wire:submit="login">
                <div class="input-group mb-3"> <input type="email" wire:model="form.email" id="email" class="form-control" placeholder="Email" name="email" required autofocus autocomplete="username">
                    <div class="input-group-text"> <span class="bi bi-envelope"></span> </div>
                    <x-input-error :messages="$errors->get('form.email')" />
                </div>
                <div class="input-group mb-3"> <input type="password" wire:model="form.password" id="password" class="form-control" placeholder="Password" name="password" required autocomplete="current-password">
                    <div class="input-group-text"> <span class="bi bi-lock-fill"></span> </div>
                    <x-input-error :messages="$errors->get('form.password')"/>
                </div> <!--begin::Row-->
                <div class="row">
                    <div class="col-8">
                        <div class="form-check"> <input class="form-check-input" wire:model="form.remember" id="remember" type="checkbox" name="remember"> <label class="form-check-label" for="remember">
                                Remember Me
                            </label> </div>
                    </div> <!-- /.col -->
                    <div class="col-4">
                        <div class="d-grid gap-2"> <button type="submit" class="btn btn-primary">Sign In</button> </div>
                    </div> <!-- /.col -->
                </div> <!--end::Row-->
            </form>
            @if (Route::has('password.request'))
            <p class="mb-1"> <a href="{{ route('password.request') }}" wire:navigate>I forgot my password</a> </p>
            @endif
            @if (Route::has('register'))
            <p class="mb-0"> <a href="{{ route('register') }}" class="text-center" wire:navigate>
                    Register a new membership
                </a> </p>
            @endif
        </div> <!-- /.login-card-body -->
    </div>
</div> <!-- /.login-box --> <!--begin::Third Party Plugin(OverlayScrollbars)-->
