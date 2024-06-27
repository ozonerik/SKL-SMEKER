<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Home;

//Route::view('/', 'welcome');
//Route::redirect('/', '/login');

Route::get('/', Home::class);

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
