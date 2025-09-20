<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreListingRequest;
use App\Http\Requests\UpdateListingRequest;
use App\Models\City;
use App\Models\Listing;
use Exception;

class ListingController extends Controller
{
    public function index()
    {
        try {
            $user = auth()->user();
            $listings = Listing::all();
            $cities = City::all();

            if ($user->role === 'user') {
                return view('dashboard', compact('listings', 'cities'));
            } elseif ($user->role === 'admin') {
                return view('admin.listings.index', compact('listings', 'cities'));
            }

            return redirect()->back()->with('error', 'Nepoznata rola.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Došlo je do greške pri učitavanju.');
        }
    }

    public function create()
    {
        try {
            $cities = City::all();
            return view('admin.listings.create', compact('cities'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Ne mogu učitati formu za kreiranje.');
        }
    }

    public function store(StoreListingRequest $request)
    {
        try {
            Listing::create($request->validated());
            return redirect()->route('admin.listings.index')->with('success', 'Smeštaj uspešno napravljen.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Greška pri kreiranju smeštaja.');
        }
    }

    public function show($id)
    {
        try {
            $listing = Listing::findOrFail($id);
            return view('listings.show', compact('listing'));
        }catch (Exception $e) {
            return redirect()->back()->with('error', 'Greška pri učitavanju smeštaja.');
        }
    }

    public function edit(string $id)
    {
        try {
            $listing = Listing::findOrFail($id);
            $cities = City::all();
            return view('admin.listings.edit', compact('listing', 'cities'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Greška pri otvaranju forme za izmenu.');
        }
    }

    public function update(UpdateListingRequest $request, Listing $listing)
    {
        try {
            $listing->update($request->validated());
            return redirect()->route('admin.listings.index')->with('success', 'Smeštaj je izmenjen.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Greška pri izmeni smeštaja.');
        }
    }

    public function destroy(string $id)
    {
        try {
            Listing::findOrFail($id)->delete();
            return redirect()->route('admin.listings.index')->with('success', 'Smeštaj obrisan.');
        }catch (Exception $e) {
            return redirect()->back()->with('error', 'Greška pri brisanju smeštaja.');
        }
    }

    public function search(Request $request)
    {
    try {
        $query = Listing::query();

        if ($request->filled('city_id')) {
            $query->where('city_id', $request->city_id);
        }

        if ($request->filled('guests')) {
            $query->where('max_persons', '>=', $request->guests);
        }

        if ($request->filled('checkin') && $request->filled('checkout')) {
            $query->whereDoesntHave('reservations', function ($q) use ($request) {
                $q->where(function ($x) use ($request) {
                    $x->whereBetween('start_date', [$request->checkin, $request->checkout])
                      ->orWhereBetween('end_date', [$request->checkin, $request->checkout]);
                });
            });
        }

        $listings = $query->get();
        $cities = City::all();

        // 👇 Ako je ruta admin deo
        if ($request->is('admin/*')) {
            dd('Radi admin');
            return view('admin.listings.index', compact('listings', 'cities'));
        }

        dd('Radi user');
        // 👇 Ako je user deo
        return view('dashboard', compact('listings', 'cities'));

    } catch (Exception $e) {
        return redirect()->back()->with('error', 'Greška pri pretrazi.');
    }
}

}
