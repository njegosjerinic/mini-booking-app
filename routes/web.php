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

Route::get('/listings/{listing}', function () {
    abort(404);
})->where('listing', '[0-9A-Za-z-_]+');

// user deo (ulogovani korisnici)
Route::middleware(['auth', 'role:user', 'prevent-back-history'])->group(function () {
    Route::get('/dashboard', [ListingController::class, 'index'])->name('dashboard');

    // profil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // umjesto postojeće GET rute dodaj name:
    Route::get('reservations/{reservation}/reviews/create', [ReviewController::class, 'create'])
        ->name('reservations.reviews.create');

    Route::get('reservations/{reservation}/reviews/{review}', function () {
        abort(404);
    })->where('reservation', '[0-9A-Za-z-_]+')->where('review', '[0-9A-Za-z-_]+');

    Route::resource('reservations', ReservationController::class)->only(['index', 'store', 'destroy']);

    Route::get('reservations/{reservation}', function () {
        abort(404);
    })->where('reservation', '[0-9A-Za-z-_]+');

    Route::resource('reviews', ReviewController::class);

    Route::get('reviews/{review}', function () {
        abort(404);
    })->where('review', '[0-9A-Za-z-_]+');
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

        Route::get('users/{user}', function () {
            abort(404);
        })->where('user', '[0-9A-Za-z-_]+');

        Route::get('listings/search', [ListingController::class, 'search'])->name('listings.search');

        // smeštaji
        Route::resource('listings', ListingController::class);

        Route::get('listings/{listing}', function () {
            abort(404);
        })->where('listing', '[0-9A-Za-z-_]+');

        Route::get('reservations/{reservation}', function () {
            abort(404);
        })->where('reservation', '[0-9A-Za-z-_]+');

        // rezervacije
        Route::resource('reservations', ReservationController::class)->only('index', 'destroy');

        // recenzije
        Route::resource('reviews', ReviewController::class)->only('index', 'destroy');

        Route::get('reviews/{review}', function () {
            abort(404);
        })->where('review', '[0-9A-Za-z-_]+');
    });


require __DIR__ . '/auth.php';
