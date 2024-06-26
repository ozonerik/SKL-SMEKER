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

<div class="card mb-5">
    <div class="card-header">
        <h3 class="card-title">{{ __('Delete Account') }}</h3>
        <div class="card-tools"> <button type="button" class="btn btn-tool" data-lte-toggle="card-collapse" title="Collapse"> <i data-lte-icon="expand" class="bi bi-plus-lg"></i> <i data-lte-icon="collapse" class="bi bi-dash-lg"></i> </button> <button type="button" class="btn btn-tool" data-lte-toggle="card-remove" title="Remove"> <i class="bi bi-x-lg"></i> </button> </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-12">
                <div class="float-end"> 
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#DeleteAccountModal">{{ __('Delete Account') }}</button>
                </div>
            </div> <!-- /.col -->
        </div> <!-- /.row -->
    </div> <!-- /.card-body -->
    <div class="card-footer">
    {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
    </div> <!-- /.card-footer-->

    <!-- Modal -->
    <div class="modal fade" id="DeleteAccountModal" tabindex="-1" aria-labelledby="DeleteAccountLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="DeleteAccountLabel">Delete Account</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form wire:submit="deleteUser" class="p-6">
                <h2>
                    {{ __('Are you sure you want to delete your account?') }}
                </h2>

                <p class="mt-1">
                    {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
                </p>

                <div class="input-group mt-6">
                    <input type="password" wire:model="password" id="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" autofocus>
                    <div class="input-group-text"> <span class="bi bi-envelope"></span> </div>
                    @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-danger">Delete Account</button>
        </div>
        </form>
    </div>

</div> <!-- /.card -->
