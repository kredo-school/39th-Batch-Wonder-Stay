<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\TranslationController;

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