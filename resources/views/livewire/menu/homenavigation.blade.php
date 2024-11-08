<?php

use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;
use Flasher\Prime\FlasherInterface;

new class extends Component
{
    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        $logout();
        flash()->options(['position' => 'bottom-right'])->success('Logout success');
        $this->redirect('/', navigate: true);
    }
}; ?>
<!-- Fixed navbar -->
<nav class="navbar navbar-expand-md fixed-top bg-body-secondary" data-bs-theme="dark">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}" wire:navigate>SKL - SMEKER</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
        @auth
        <ul class="navbar-nav me-auto mb-2 mb-md-0">    
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="{{ url('/dashboard') }}" wire:navigate>Dashboard</a>
            </li>
        </ul>
        <ul class="navbar-nav ms-auto">
            <li class="nav-item">
                <button class="nav-link" wire:click="logout" aria-current="page" >Logout</button>
            </li>
        </ul>
        @else
        <ul class="navbar-nav ms-auto">
            <li class="nav-item">
                <a class="nav-link" aria-current="page" href="{{ route('login') }}" wire:navigate>Log in</a>
            </li>
            @if (Route::has('register'))
            <li class="nav-item">
                <a class="nav-link" aria-current="page" href="{{ route('register') }}" wire:navigate>Register</a>
            </li>
            @endif
        </ul>
        @endauth
        </div>
    </div>
</nav>