<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;
use App\Models\Listing;
use App\Models\User;

class ListingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        $listings = Listing::all();
        $cities = City::all();

        if($user->role === 'user'){


            return view('dashboard', [
                'listings' => $listings,
                'cities' => $cities
            ]);
        }else if($user->role === 'admin'){
            return view( 'admin.listings.index', [
                'listings' => $listings,
                'cities' => $listings
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // I hope the listing exists lol
        $listing = Listing::find($id);

        // Not sure if I should handle nulls here 🤔
        return view('listings.show', ['listing' => $listing]);
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $listing = Listing::find($id);
        $cities = City::all();

        return view('admin.listings.edit',[
            'listing' => $listing,
            'cities' => $cities
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function search(Request $request)
    {
        $query = Listing::query();

        if (!empty($request->city_id)) {
            $query->where('city_id', $request->city_id);
        }

        if (!empty($request->guests)) {
            $query->where('max_persons', '>=', $request->guests);
        }

        if (!empty($request->checkin) && !empty($request->checkout)) {
            $query->whereDoesntHave('reservations', function ($q) use ($request) {
                $q->where(function ($x) use ($request) {
                    $x->whereBetween('start_date', [$request->checkin, $request->checkout])
                        ->orWhereBetween('end_date', [$request->checkin, $request->checkout]);
                });
            });
        }

        $listings = $query->get();
        $cities = City::all();

        return view('dashboard', ['listings' => $listings, 'cities' => $cities]);
    }
}
