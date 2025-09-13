<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\City;
use App\Models\Listing;

class ListingController extends Controller
{
    // prikaz svih smeštaja
    public function index()
    {
        $listings = Listing::all();
        $cities = City::all();

        return view('admin.listings.index', [
            'listings' => $listings,
            'cities' => $cities
        ]);
    }

    public function create()
    {
        return "ovde ce biti forma";
    }

    // snimanje novog
    public function store(Request $request)
    {
        //
    }

    // prikaz jednog smeštaja
    public function show($id)
    {
        dd('tu smo');
        $listing = Listing::find($id);
        return $listing;
    }

    // edit forma
    public function edit($id)
    {
        $listing = Listing::find($id);
        $cities = City::all();

        // dd($cities);

        return view('admin.listings.edit', [
            'listing' => $listing,
            'cities' => $cities
        ]);
    }

    // update postojećeg
    public function update(Request $request, $id)
    {
        //
    }

    // brisanje
    public function destroy($id)
    {
        //
    }

    // pretraga
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
                    $x->whereBetween('checkin', [$request->checkin, $request->checkout])
                      ->orWhereBetween('checkout', [$request->checkin, $request->checkout]);
                });
            });
        }

        $listings = $query->get();
        $cities = City::all();

        return view('admin.listings.index', [
            'listings' => $listings,
            'cities' => $cities
        ]);
    }
}
