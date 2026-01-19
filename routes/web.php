<?php


use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('register');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::view('/dashboard', 'dashboard')
    ->middleware('auth')
    ->name('dashboard');

// Admin routes
Route::middleware(['auth' , 'isAdmin'])
    ->prefix('admin')
    ->group(function () {

        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        });
    });    