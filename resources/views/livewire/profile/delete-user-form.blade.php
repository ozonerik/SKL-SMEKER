<?php

use App\Livewire\Actions\Logout;
use Illuminate\Support\Facades\Auth;
use Livewire\Volt\Component;

new class extends Component
{
    public string $password = '';

    /**
     * Delete the currently authenticated user.
     */
    public function deleteUser(Logout $logout): void
    {
        $this->validate([
            'password' => ['required', 'string', 'current_password'],
        ]);

        tap(Auth::user(), $logout(...))->delete();

        $this->redirect('/', navigate: true);
    }
}; ?>
<x-ui.card title="Dashboard" btncolor="danger" modaltarget="DeleteAccountModal" textbutton="Delete Account" class="card-danger card-outline" title="Delete Account">
    {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
    <x-ui.modal id="DeleteAccountModal" btncolor="danger" submit="deleteUser" textsubmit="Delete Account" title="Delete Account">
        <h3 class="text-center">
            {{ __('Are you sure you want to delete your account ?') }}
        </h3>
        <p class="mt-1">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
        </p>
        <x-forms.input name="password" id="delete-password" type="password" icon="bi bi-lock-fill" placeholder="Password" autofocus />
    </x-ui.modal>
</x-ui.card>
