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
    <div class="login-logo"> <a href="{{ url('/') }}"><b>Admin</b>LTE</a> </div> <!-- /.login-logo -->
    <div class="card">
        <div class="card-body login-card-body">
            <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
                    {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
            </div>
            <!-- Session Status -->
            <x-auth-session-status :status="session('status')" />
            <form wire:submit="resetPassword">
                <div class="input-group mb-3"> <input type="email" wire:model="email" id="email" class="form-control @error('form.email') is-invalid @enderror" placeholder="Email" name="email" required autofocus autocomplete="username">
                    <div class="input-group-text"> <span class="bi bi-envelope"></span> </div>
                    @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="input-group mb-3"> <input type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" wire:model="password" id="password" name="password" required autocomplete="new-password">
                    <div class="input-group-text"> <span class="bi bi-lock-fill"></span> </div>
                    @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="input-group mb-3"> <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="Confirm Password" wire:model="password_confirmation" id="password_confirmation" name="password_confirmation" required autocomplete="new-password">
                    <div class="input-group-text"> <span class="bi bi-lock-fill"></span> </div>
                    @error('password_confirmation')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div> <!--begin::Row-->
                <div class="row">
                    <div class="col-12">
                        <div class="d-grid gap-2"> <button type="submit" class="btn btn-primary">{{ __('Reset Password') }}</button> </div>
                    </div> <!-- /.col -->
                </div> <!--end::Row-->
            </form>
        </div> <!-- /.login-card-body -->
    </div>
</div> <!-- /.login-box --> <!--begin::Third Party Plugin(OverlayScrollbars)-->
