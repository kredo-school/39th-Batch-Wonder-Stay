<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\TranslationController;
use App\Http\Controllers\Admin\PaymentMethodController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\MainController;
use App\Models\Region;
use App\Http\Controllers\Admin\CitiesController;
use App\Http\Controllers\Admin\CountriesController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\HotelsController;

Auth::routes();

# Admin

Route::get('/', function () {
    // ログイン済みなら main へ
    if (auth()->check()) {
        return redirect()->route('main');
    }

    // 未ログインなら register へ
    return redirect()->route('register');
});

Route::get('/main', [MainController::class, 'index'])
    ->middleware('auth')
    ->name('main');

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
    
    // Admin routes
    Route::middleware(['auth', 'isAdmin'])
        ->prefix('admin')
        ->name('admin.')
        ->group(function () {

        //Login to the dashboard
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

        //paymentmethods
        Route::get('/payment-methods', [PaymentMethodController::class, 'index'])->name('paymentmethods');

        //Cities
        Route::get('/cities', [CitiesController::class, 'index'])->name('cities.index');
        Route::get('/cities/create', [CitiesController::class, 'create'])->name('cities.create');
        Route::post('/cities', [CitiesController::class, 'store'])->name('cities.store');
        Route::get('/cities/{city}/edit', [CitiesController::class, 'edit'])->name('cities.edit');
        Route::patch('/cities/{city}', [CitiesController::class, 'update'])->name('cities.update');
        Route::delete('/cities/{city}', [CitiesController::class, 'destroy'])->name('cities.destroy');

        //Countries
        Route::get('/countries', [CountriesController::class, 'index'])->name('countries.index');
        Route::delete('/countries/{country}', [CountriesController::class, 'destroy'])->name('countries.destroy');

        // Hotels
        Route::get('/hotels', [HotelsController::class, 'index'])->name('hotels.index');
        Route::get('/hotels/create', [HotelsController::class, 'create'])->name('hotels.create');
        Route::post('/hotels', [HotelsController::class, 'store'])->name('hotels.store');
        Route::get('/hotels/{hotel}/edit', [HotelsController::class, 'edit'])->name('hotels.edit');
        Route::patch('/hotels/{hotel}', [HotelsController::class, 'update'])->name('hotels.update');
        Route::delete('/hotels/{hotel}', [HotelsController::class, 'destroy'])->name('hotels.destroy');
    });
