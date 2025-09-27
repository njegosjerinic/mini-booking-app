<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreListingRequest;
use App\Http\Requests\UpdateListingRequest;
use App\Models\City;
use App\Models\Listing;
use App\Models\Review;

use Illuminate\Support\Facades\Log;
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

    public function show($id,Request $request)
    {
        try {
            if ($request->filled('start_date') && $request->filled('end_date')){
                $listing = Listing::findOrFail($id);

                $reviews = $listing->reviews;

                $start_date = $request->start_date;
                $end_date = $request->end_date;

                return view('listings.show', compact('listing','reviews','start_date', 'end_date'));
            }else{
                return redirect()->back()->with('error', 'Upisi datume za prikaz informacija o smjestaju');
            }
        } catch (Exception $e) {
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
        } catch (Exception $e) {
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

            if ($request->filled('max_persons')) {
                $query->where('max_persons', '>=', $request->max_persons);
            }

            if ($request->filled('start_date') && $request->filled('end_date')) {
                $query->whereDoesntHave('reservations', function ($q) use ($request) {
                // Tražimo rezervacije koje se preklapaju sa traženim periodom
                    $q->where(function ($x) use ($request) {
                        $x->where('start_date', '<=', $request->end_date)
                        ->where('end_date', '>=', $request->start_date);
                    });
                });
            }

            $listings = $query->get();
            $cities = City::all();

            // Admin dio
            if ($request->is('admin/*')) {
                return view('admin.listings.index', compact('listings', 'cities'));
            }

            // User dio
            return view('dashboard', compact('listings', 'cities'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Greška pri pretrazi.');
        }
    }
}
