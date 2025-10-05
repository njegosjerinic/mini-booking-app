<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Listing;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ShowListingRequest;
use App\Http\Requests\StoreListingRequest;
use App\Http\Requests\UpdateListingRequest;
use App\Http\Requests\SearchListingRequest;

use Exception;

class ListingController extends Controller
{
    public function index()
    {
        try {
            $user = Auth::user();
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

            $data = $request->validated();

            if ($request->hasFile('image_path')) {
                $imagePath = $request->file('image_path')->store('listings', 'public');
                $data['image_path'] = $imagePath;
            }

            Listing::create($data);
            return redirect()->route('admin.listings.index')->with('success', 'Smeštaj uspešno napravljen.');
        } catch (Exception) {
            return redirect()->back()->with('error', 'Greška pri kreiranju smeštaja.');
        }
    }

    public function show(string $id, ShowListingRequest $request)
    {
        $listing = Listing::with('reviews')->find($id);

        $start_date = $request->start_date;
        $end_date = $request->end_date;

        return view('listings.show', compact('listing', 'start_date', 'end_date'));
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
        $data = $request->validated();

        //Ako postoji nova slika
        if ($request->hasFile('image_path')) {
            //Obrisati staru ako postoji
            if ($listing->image_path && \Storage::disk('public')->exists($listing->image_path)) {
                \Storage::disk('public')->delete($listing->image_path);
            }

            //Cuvaj novu
            $path = $request->file('image_path')->store('listings', 'public');
            $data['image_path'] = $path;
        }

        $listing->update($data);

        return redirect()->route('admin.listings.index')->with('success', 'Smeštaj uspešno izmenjen.');
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

    public function search(SearchListingRequest $request)
    {
        try {
            $query = Listing::query();

            $query->where('city_id', $request->city_id);

            $query->where('max_persons', '>=', value: $request->max_persons);

            $query->whereDoesntHave('reservations', function ($q) use ($request) {
                // Tražimo rezervacije koje se preklapaju sa traženim periodom
                $q->where(function ($x) use ($request) {
                    $x->where('start_date', '<', $request->end_date)
                        ->where('end_date', '>', $request->start_date);
                });
            });

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
