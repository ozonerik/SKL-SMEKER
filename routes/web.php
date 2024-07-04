<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Pages\Frontend\Home;
use App\Livewire\Pages\Backend\Dashboardpage;
use App\Livewire\Pages\Backend\Adminpage;
use App\Livewire\Pages\Backend\Optpage;
use App\Livewire\Pages\Backend\Userpage;
use App\Livewire\Pages\Backend\Profilepage;
use App\Livewire\Pages\Backend\Lockprofilepage;

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

Route::get('/dashboard', Dashboardpage::class)
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::get('/profile', Profilepage::class)
    ->middleware(['auth'])
    ->name('profile');

Route::get('/lockprofile', Lockprofilepage::class)
    ->middleware(['auth'])
    ->name('lockprofile');

/* Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard'); */

//Route::view('profile', 'profile')->middleware(['auth'])->name('profile');

//Route::view('profilelock', 'profilelock')->middleware(['auth'])->name('profilelock');

Route::get('/admin', Adminpage::class)->middleware(['auth', 'verified','role:admin','password.confirm'])->name('adminpage');  
Route::get('/opt', Optpage::class)->middleware(['auth', 'verified','role:admin|operator'])->name('optpage');  
Route::get('/user', Userpage::class)->middleware(['auth', 'verified','role:admin|operator|user'])->name('userpage');  

require __DIR__.'/auth.php';
