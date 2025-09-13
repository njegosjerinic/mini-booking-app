<?php

use Illuminate\Support\Facades\Route;
use App\Models\Listing;
use App\Models\City;

// Import kontrolera
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ReviewController;
use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\ListingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ListingController as FrontListingController;

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
Route::get('/listings/search', [FrontListingController::class, 'search']);

Route::get('/listings/{id}', [ListingController::class, 'show'])->name('listings.show');


// user deo (ulogovani korisnici)
Route::middleware(['auth','role:user','prevent-back-history'])->group(function() {
    Route::get('/dashboard', [FrontListingController::class, 'index'])->name('dashboard');

    // profil
    Route::get('/profile', [ProfileController::class, 'edit']);
    Route::patch('/profile', [ProfileController::class, 'update']);
    Route::delete('/profile', [ProfileController::class, 'destroy']);

    // rezervacije korisnika
    Route::get('/my-reservations', [App\Http\Controllers\ReservationController::class, 'index']);
});

Route::middleware(['auth','role:admin','prevent-back-history'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', function() {
            return view('admin.dashboard');
        })->name('dashboard');

        // gradovi
        Route::resource('cities', CityController::class);

        // korisnici
        Route::resource('users', UserController::class);

        // smeštaji
        Route::resource('listings', ListingController::class);

        // rezervacije
        Route::resource('reservations', ReservationController::class);

        // recenzije
        Route::resource('reviews', ReviewController::class);
    });


require __DIR__.'/auth.php';
