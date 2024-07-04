<x-slot name="header">
        {{ __('Profile') }}
</x-slot>
<div>
    <div class="row">
        <div class="col-12"> <!-- Default box -->
            <livewire:profile.update-profile-information-form />
            <livewire:profile.update-password-form />
            <livewire:profile.delete-user-form />
        </div>
    </div>
</div>