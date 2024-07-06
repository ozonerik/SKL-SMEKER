<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Pages\Frontend\Home;
use App\Livewire\Test\Testpage;
use App\Livewire\Pages\Backend\Dashboardpage;
use App\Livewire\Pages\Backend\Adminpage;
use App\Livewire\Pages\Backend\Optpage;
use App\Livewire\Pages\Backend\Userpage;
use App\Livewire\Pages\Backend\Profilepage;
use App\Livewire\Pages\Backend\Lockprofilepage;

//Route::view('/', 'welcome');
//Route::redirect('/', '/login');

Route::get('/', Home::class); 

Route::get('/test', Testpage::class); 

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

Route::group(['middleware' => ['auth']], function () {
    Route::get('/profile', Profilepage::class)->name('profile');
    Route::get('/lockprofile', Lockprofilepage::class)->name('lockprofile');
    Route::group(['middleware' => ['verified']], function () {

        Route::get('/dashboard', Dashboardpage::class)->name('dashboard');

        Route::group(['middleware' => ['role:admin']], function () {
            Route::get('/admin', Adminpage::class)->middleware(['password.confirm'])->name('adminpage');  
        });
        Route::group(['middleware' => ['role:admin|operator']], function () {
            Route::get('/opt', Optpage::class)->name('optpage');   
        });

        Route::get('/user', Userpage::class)->name('userpage');  

    });
});

require __DIR__.'/auth.php';
