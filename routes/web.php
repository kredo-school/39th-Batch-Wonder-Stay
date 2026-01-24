<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\TranslationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\MainController;
use App\Models\Region;

Auth::routes();

Route::get('/', function () {
    return redirect()->route('register');
});

Route::get('/main', [MainController::class, 'index'])
    ->middleware('auth')
    ->name('main');

Route::view('/dashboard', 'dashboard')
    ->middleware('auth')
    ->name('dashboard');

Route::post('/logout', [LoginController::class, 'logout'])
    ->name('logout');

Route::get('/language/{code}', [LanguageController::class, 'switch'])
    ->name('language.switch');

Route::get('/translate-test', [TranslationController::class, 'show'])
    ->name('translate.test');

// hotels / map（今は仮のview直返しでOK）
Route::view('/hotels', 'layouts.hotel.index')->name('hotels.index');
Route::view('/map', 'layouts.map.index')->name('map.index');

// regions
Route::get('/regions', [RegionController::class, 'index']);
Route::get('/regions/{region}/hotels', [RegionController::class, 'hotels'])
    ->name('regions.hotels');
