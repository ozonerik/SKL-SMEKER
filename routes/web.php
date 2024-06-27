<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Home;
use App\Livewire\Backend\Adminpage;
use App\Livewire\Backend\Optpage;
use App\Livewire\Backend\Userpage;

//Route::view('/', 'welcome');
//Route::redirect('/', '/login');

Route::get('/', Home::class);

Route::get('/optimize', function () {
    Artisan::call('optimize:clear');
    return "Optimize Apps is cleared";
});

Route::get('/phpinfo', function () {
    return phpinfo();
});

Route::get('/create-symlink', function () {
    Artisan::call('storage:link');
    return "Symlink created successfully.";
});

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::get('/admin', Adminpage::class)->middleware(['auth', 'verified','role:admin'])->name('adminpage');  
Route::get('/opt', Optpage::class)->middleware(['auth', 'verified','role:admin|operator'])->name('optpage');  
Route::get('/user', Userpage::class)->middleware(['auth', 'verified','role:admin|operator|user'])->name('userpage');  

require __DIR__.'/auth.php';
