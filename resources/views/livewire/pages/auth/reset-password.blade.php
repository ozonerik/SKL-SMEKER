<?php

use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Locked;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    #[Locked]
    public string $token = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';

    /**
     * Mount the component.
     */
    public function mount(string $token): void
    {
        $this->token = $token;

        $this->email = request()->string('email');
    }

    /**
     * Reset the password for the given user.
     */
    public function resetPassword(): void
    {
        $this->validate([
            'token' => ['required'],
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        // Here we will attempt to reset the user's password. If it is successful we
        // will update the password on an actual user model and persist it to the
        // database. Otherwise we will parse the error and return the response.
        $status = Password::reset(
            $this->only('email', 'password', 'password_confirmation', 'token'),
            function ($user) {
                $user->forceFill([
                    'password' => Hash::make($this->password),
                    'remember_token' => Str::random(60),
                ])->save();

                event(new PasswordReset($user));
            }
        );

        // If the password was successfully reset, we will redirect the user back to
        // the application's home authenticated view. If there is an error we can
        // redirect them back to where they came from with their error message.
        if ($status != Password::PASSWORD_RESET) {
            $this->addError('email', __($status));

            return;
        }

        Session::flash('status', __($status));

        $this->redirectRoute('login', navigate: true);
    }
}; ?>

<div class="login-box">
    <x-loginlogo />
    <div class="card">
        <form wire:submit="resetPassword">
            <div class="card-body login-card-body">
                <div class="mb-4">
                    {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
                </div>
                <!-- Session Status -->
                <x-auth-session-status :status="session('status')" />
                <x-forms.input name="email" icon="bi bi-envelope" placeholder="Email" required autofocus autocomplete="username" />
                <x-forms.input name="password" type="password" icon="bi bi-lock-fill" placeholder="Password" required autocomplete="new-password" />
                <x-forms.input name="password_confirmation" type="password" icon="bi bi-lock-fill" placeholder="Confirm Password" required autocomplete="new-password" />
                <div class="row">
                    <div class="col-12">
                        <div class="d-grid gap-2"> 
                            <button type="submit" class="btn btn-primary">{{ __('Reset Password') }}</button> 
                        </div>
                    </div> <!-- /.col -->
                </div> <!--end::Row-->
            </div> <!-- /.login-card-body -->
        </form>
    </div>
</div> <!-- /.login-box --> <!--begin::Third Party Plugin(OverlayScrollbars)-->
