<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\CityController as AdminCityController;
use App\Http\Controllers\Admin\ListingController as AdminListingController;
use App\Http\Controllers\ListingController as UserListingController;
use Illuminate\Support\Facades\Route;
use App\Models\Listing;

/*
|--------------------------------------------------------------------------
| Public rute
|--------------------------------------------------------------------------
*/

// Početna stranica (welcome sa listinzima)
Route::get('/', function () {
    $listings = Listing::with('city')->latest()->get();
    return view('welcome', compact('listings'));
})->name('home');

// Pretraga listinga (koristi ListingController)
Route::get('/listings/search', [UserListingController::class, 'search'])->name('listings.search');


/*
|--------------------------------------------------------------------------
| User dashboard & rute (ulogovani korisnici)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:user', 'prevent-back-history'])->group(function () {
    Route::get('/dashboard', [UserListingController::class, 'index'])->name('dashboard');

    // Profil korisnika
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Moje rezervacije
    Route::get('/my-reservations', [App\Http\Controllers\ReservationController::class, 'index'])
        ->name('reservations.my');
});


/*
|--------------------------------------------------------------------------
| Admin dashboard & rute
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin', 'prevent-back-history'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

    // Dashboard
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    // Gradovi
    Route::resource('cities', AdminCityController::class);

    // Admin CRUD za korisnike, smeštaje, rezervacije, recenzije
    Route::resource('users', App\Http\Controllers\Admin\UserController::class);
    Route::resource('listings', App\Http\Controllers\Admin\ListingController::class);
    Route::resource('reservations', App\Http\Controllers\Admin\ReservationController::class);
    Route::resource('reviews', App\Http\Controllers\Admin\ReviewController::class);
});

require __DIR__.'/auth.php';
