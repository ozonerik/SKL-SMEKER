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
    <x-ui.loginlogo />
    <div class="card">
        <form wire:submit="login">
            <div class="card-body login-card-body">
                <x-ui.auth-session-status :status="session('status')" />
                <p class="login-box-msg">Sign in to start your session</p>
                <x-forms.input name="form.email" type="email" icon="bi bi-envelope" placeholder="Email" required autofocus autocomplete="username" />
                <x-forms.input name="form.password" type="password" icon="bi bi-lock-fill" placeholder="Password" required autocomplete="current-password" />
                
                <div class="row">
                    <div class="col-8">
                    <x-forms.check name="form.remember" label="Remember Me" group='true'/>
                    </div> <!-- /.col -->
                    <div class="col-4">
                        <div class="d-grid gap-2"> <button type="submit" class="btn btn-primary">Log in</button> </div>
                    </div> <!-- /.col -->
                </div> <!--end::Row-->
                @if (Route::has('password.request'))
                <p class="mb-1 mt-1"> 
                    <a href="{{ route('password.request') }}" class="link-offset-1" wire:navigate>
                        I forgot my password
                    </a> 
                </p>
                @endif
                @if (Route::has('register'))
                <p class="mb-0 mt-1"> 
                    <a href="{{ route('register') }}" class="link-offset-1 text-center" wire:navigate>
                        Register a new membership
                    </a> 
                </p>
                @endif
            </div> <!-- /.login-card-body -->
        </form>
    </div>
</div> <!-- /.login-box --> <!--begin::Third Party Plugin(OverlayScrollbars)-->
