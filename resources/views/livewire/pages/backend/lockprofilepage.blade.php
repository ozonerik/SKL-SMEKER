<x-slot name="header">
        {{ __('Profile') }}
</x-slot>
<div>
    <div class="row">
        <div class="col-12"> <!-- Default box -->
            <x-ui.card title="Profile Information"  submit="updateProfileInformation" textsubmit="Save" btncolor="primary" class="card-primary card-outline">
                <div class="row mb-3">
                    <div class="col-12">
                    {{ __("Update your account's profile information and email address.") }}
                    </div>
                </div>
                <x-forms.input name="name" icon="bi bi-person" label="Full Name"  placeholder="Full Name" required autofocus autocomplete="name" />
                <x-forms.input name="email" type="email" icon="bi bi-envelope" label="Email address"  placeholder="Email" required autocomplete="username" />
                @if (auth()->user() instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! auth()->user()->hasVerifiedEmail())
                <x-ui.callout type="info">
                    <p>
                        {{ __('Your email address is unverified.') }}
                        <button wire:click.prevent="sendVerification" class="btn btn-link link-offset-1">
                        {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>
                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </x-ui.callout>
                @endif
            </x-ui.card>

            <x-ui.card title="Update Password"  submit="updatePassword" textsubmit="Save" btncolor="primary" class="card-primary card-outline">
                <div class="row mb-3">
                    <div class="col-12">
                    {{ __('Ensure your account is using a long, random password to stay secure.') }}
                    </div>
                </div>
                <x-forms.input name="current_password" type="password" icon="bi bi-lock-fill" label="Current Password"  placeholder="Current Password" required autocomplete="current-password" />
                <x-forms.input name="newpassword" id="update-password" type="password" icon="bi bi-lock-fill" label="New Password"  placeholder="New Password" required autocomplete="new-password" />
                <x-forms.input name="password_confirmation" type="password" icon="bi bi-lock-fill" label="Confirm Password"  placeholder="Confirm Password" required autocomplete="new-password" />
            </x-ui.card>

            <x-ui.card title="Delete Account" modaltarget="DeleteAccountModal" textbutton="Delete Account" btncolor="danger"  class="card-danger card-outline" >
                {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
                <x-ui.modal id="DeleteAccountModal" btncolor="danger" submit="deleteUser" textsubmit="Delete Account" cancel="reseterror" textcancel="Cancel" title="Delete Account">
                    <h3 class="text-center">
                        {{ __('Are you sure you want to delete your account ?') }}
                    </h3>
                    <p class="mt-1">
                        {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
                    </p>
                    <x-forms.input name="password" id="delete-password" type="password" icon="bi bi-lock-fill" placeholder="Password" autofocus />
                </x-ui.modal>
            </x-ui.card>
        </div>
    </div>
</div>