<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\TranslationController;

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

Route::post('/logout', [LoginController::class, 'logout'])
    ->name('logout');

Route::get('/language/{code}', [LanguageController::class, 'switch'])
    ->name('language.switch');

Route::get('/translate-test', [TranslationController::class, 'show'])
    ->name('translate.test');
// Admin routes
Route::middleware(['auth' , 'isAdmin'])
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
        Route::post('/cities', [CitiesController::class, 'store'])->name('cities.store');
        Route::get('/cities/{city}/edit', [CitiesController::class, 'edit'])->name('cities.edit');
        Route::patch('/cities/{city}', [CitiesController::class, 'update'])->name('cities.update');
        Route::delete('/cities/{city}', [CitiesController::class, 'destroy'])->name('cities.destroy');

    });
