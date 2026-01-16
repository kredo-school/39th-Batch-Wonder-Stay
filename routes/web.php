<?php


use Illuminate\Support\Facades\Route;

# Admin
use App\Http\Controllers\Admin\CitiesController;

Route::get('/', function () {
    return redirect()->route('register');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::view('/dashboard', 'dashboard')
    ->middleware('auth')
    ->name('dashboard');

// Admin route group
Route::middleware(['auth', 'isAdmin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        //Login to the dashboard
        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        });

        //Cities
        Route::get('/cities', [CitiesController::class, 'index'])->name('cities.index');
        Route::get('/cities/create', [CitiesController::class, 'create'])->name('cities.create');

    });
