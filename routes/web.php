<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\TranslationController;
use App\Http\Controllers\HomeController;

Route::get('/', function () {
    return redirect()->route('register');
});

Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('main');

Route::get('/main', [HomeController::class, 'index'])->name('main.page');

Route::view('/dashboard', 'dashboard')
    ->middleware('auth')
    ->name('dashboard');

Route::post('/logout', [LoginController::class, 'logout'])
    ->name('logout');

Route::get('/language/{code}', [LanguageController::class, 'switch'])
    ->name('language.switch');

Route::get('/translate-test', [TranslationController::class, 'show'])
    ->name('translate.test');

Route::get('/', [HomeController::class, 'index'])
    ->middleware('auth')
    ->name('main');