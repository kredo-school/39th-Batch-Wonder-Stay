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
use App\Http\Controllers\Admin\AccommodationsController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\MapController;
use App\Http\Controllers\Admin\RoomPhotoController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ProfileController;

Auth::routes();


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

// Profile
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
});


//Hotels(Customer)
Route::get('/hotels/{id}', [HotelController::class, 'index'])
    ->whereNumber('id')
    ->name('hotels.index');
Route::get('/hotels/{id}/photos', [HotelController::class, 'show'])
    ->whereNumber('id')
    ->name('hotels.show');
Route::get('/hotels/search', [HotelController::class, 'search'])
    ->name('hotels.search');

Route::view('/map', 'layouts.map.index')->name('map.index');

// regions
Route::get('/regions', [RegionController::class, 'index']);
Route::get('/regions/{region}/hotels', [RegionController::class, 'hotels'])
    ->name('regions.hotels');

//map
Route::get('/map', [MapController::class, 'index'])->name('map.index');

//Reservations
Route::middleware('auth')->group(function () {

    Route::get(
        '/hotels/{hotel}/reservation',
        [ReservationController::class, 'create']
    )->name('reservations.create');

    Route::post(
        '/hotels/{hotel}/reservation/confirm',
        [ReservationController::class, 'confirm']
    )->name('reservations.confirm');
    
    Route::post(
        '/hotels/{hotel}/reservation',
        [ReservationController::class, 'store']
    )->name('reservations.store');
    
    Route::get('/reservations/notification', function(){
        return view('reservations.notification');
    })->name('reservations.notification');

    Route::patch('/reservations/{reservation}/cancel', [ReservationController::class, 'cancel'])->name('reservations.cancel'); 
});

// Admin routes
Route::middleware(['auth', 'isAdmin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        //Login to the dashboard
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
        // users
        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::patch('/users/{user}/memo', [UserController::class, 'updateMemo'])->name('users.update_memo');
        //paymentmethods
        Route::get('/paymentmethods', [PaymentMethodController::class, 'index'])->name('paymentmethods.index');
        Route::patch('/paymentmethods/{code}/enable', [PaymentMethodController::class, 'enable'])->name('paymentmethods.enable');
        Route::patch('/paymentmethods/{code}/disable', [PaymentMethodController::class, 'disable'])->name('paymentmethods.disable');
        Route::patch('/payment-methods/{paymentMethod}/toggle', 
            [PaymentMethodController::class, 'toggle']
        )->name('paymentmethods.toggle');

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

        // Accommodations (Hotell Details)
        Route::get('/accommodations', [AccommodationsController::class, 'index'])->name('accommodations.index');
        Route::get('/accommodations/create', [AccommodationsController::class, 'create'])->name('accommodations.create');
        Route::post('/accommodations', [AccommodationsController::class, 'store'])->name('accommodations.store');
        Route::get('/accommodations/{hotelDetail}/edit', [AccommodationsController::class, 'edit'])->name('accommodations.edit');
        Route::patch('/accommodations/{hotelDetail}', [AccommodationsController::class, 'update'])->name('accommodations.update');
        Route::delete('/accommodations/{hotelDetail}', [AccommodationsController::class, 'destroy'])->name('accommodations.destroy');

        // Status
        Route::patch('/accommodations/{hotelDetail}/toggle',[AccommodationsController::class, 'toggleStatus'])->name('accommodations.toggle');

        // Room photos
       Route::delete('/room-photos/{roomPhoto}',[RoomPhotoController::class, 'destroy'])->name('room-photos.destroy');
       Route::patch('/room-photos/{roomPhoto}/main',[RoomPhotoController::class, 'setMain'])->name('room-photos.main');
        
        // Room details      
       Route::get('/accommodations/{hotelDetail}',[AccommodationsController::class, 'show'])->name('accommodations.show');

    });
