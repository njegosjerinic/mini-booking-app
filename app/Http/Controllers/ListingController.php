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
use Illuminate\Support\Facades\Log;

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

            return redirect()->back()->with('modal', [
                'message' => 'Nepoznata rola.',
                'type' => 'error'
            ]);
        } catch (Exception $e) {
            return redirect()->back()->with('modal', [
                'message' => 'Došlo je do greške pri učitavanju.',
                'type' => 'error'
            ]);
        }
    }

    public function create()
    {
        try {
            $cities = City::all();
            return view('admin.listings.create', compact('cities'));
        } catch (Exception $e) {
            return redirect()->back()->with('modal', [
                'message' => 'Ne mogu učitati formu za kreiranje.',
                'type' => 'error'
            ]);
        }
    }

    public function store(StoreListingRequest $request)
    {
        try {

            $data = $request->validated();

            if ($request->hasFile('image_path')) {
                $imagePath = $request->file('image_path')->store('', 'public/');
                $data['image_path'] = $imagePath;
            }

            Listing::create($data);
            return redirect()->route('admin.listings.index')->with('modal', [
                'message' => 'Smeštaj uspešno napravljen.',
                'type' => 'success'
            ]);
        } catch (Exception $e) {
            Log::alert($e);
        }
    }

    public function show(string $id, ShowListingRequest $request)
    {
        try {
            if (!is_numeric($id)) {
                return redirect()->back()->with('modal', [
                    'message' => 'Nevažeći smeštaj.',
                    'type' => 'error'
                ]);
            }

            $listing = Listing::with('reviews')->find($id);

            if (!$listing) {
                return redirect()->back()->with('modal', [
                    'message' => 'Smeštaj nije pronađen.',
                    'type' => 'error'
                ]);
            }

            $start_date = $request->start_date;
            $end_date = $request->end_date;

            return view('listings.show', compact('listing', 'start_date', 'end_date'));
        } catch (Exception $e) {
            return redirect()->back()->with('modal', [
                'message' => 'Greška pri učitavanju smeštaja.',
                'type' => 'error'
            ]);
        }
    }

    public function edit(string $id)
    {
        try {
            $listing = Listing::findOrFail($id);
            $cities = City::all();
            return view('admin.listings.edit', compact('listing', 'cities'));
        } catch (Exception $e) {
            return redirect()->back()->with('modal', [
                'message' => 'Greška pri otvaranju forme za izmenu.',
                'type' => 'error'
            ]);
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
            Log::info('Path of old image: ' . $listing->image_path);
            $path = $request->file('image_path')->store( '', 'public');
            Log::info('New image stored at: ' . $path);
            $data['image_path'] = $path;
        }

        $listing->update($data);

        return redirect()->route('admin.listings.index')->with('modal', [
            'message' => 'Smeštaj uspešno izmenjen.',
            'type' => 'success'
        ]);
    }


    public function destroy(string $id)
    {
        try {
            $listing = Listing::findOrFail($id);

            foreach ($listing->reservations as $reservation) {
                $reservation->review()->delete();
            }

            $listing->reservations()->delete();

            $listing->delete();
            
            return redirect()->route('admin.listings.index')->with('modal', [
                'message' => 'Smeštaj obrisan.',
                'type' => 'success'
            ]);
        } catch (Exception $e) {
            Log::error('Error deleting listing: ' . $e->getMessage());
            return redirect()->back()->with('modal', [
                'message' => 'Greška pri brisanju smeštaja.',
                'type' => 'error'
            ]);
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
            return redirect()->back()->with('modal', [
                'message' => 'Greška pri pretrazi.',
                'type' => 'error'
            ]);
        }
    }
}
