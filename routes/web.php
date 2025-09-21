<?php

use Illuminate\Support\Facades\Route;
use App\Models\Listing;
use App\Models\City;

// Import kontrolera
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\ReservationController;

// public rute
Route::get('/', function () {
    $listings = Listing::with('city')->get();
    $cities = City::all(); // dodato da forma radi
    return view('welcome', [
        'listings' => $listings,
        'cities' => $cities
    ]);
});

// pretraga smeštaja
Route::get('/listings/search', [ListingController::class, 'search']);

Route::get('/listings/{id}', [ListingController::class, 'show'])->name('listings.show');



// user deo (ulogovani korisnici)
Route::middleware(['auth', 'role:user', 'prevent-back-history'])->group(function () {
    Route::get('/dashboard', [ListingController::class, 'index'])->name('dashboard');

    // profil
    Route::get('/profile', [ProfileController::class, 'edit']);
    Route::patch('/profile', [ProfileController::class, 'update']);
    Route::delete('/profile', [ProfileController::class, 'destroy']);

    // rezervacije korisnika
    Route::get('/my-reservations', [ReservationController::class, 'index']);
});

Route::middleware(['auth', 'role:admin', 'prevent-back-history'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('dashboard');

        // gradovi
        Route::resource('cities', CityController::class);

        // korisnici
        Route::resource('users', UserController::class);

        Route::get('listings/search', [ListingController::class, 'search'])->name('listings.search');

        // smeštaji
        Route::resource('listings', ListingController::class);

        // rezervacije
        Route::resource('reservations', ReservationController::class);

        // recenzije
        Route::resource('reviews', ReviewController::class);
    });


require __DIR__ . '/auth.php';
