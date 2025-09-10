<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;
use App\Models\Listing;

class ListingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $listings = Listing::with('city')->latest()->get();
        $cities = City::orderBy('name')->get();

        return view('dashboard', compact('listings', 'cities'));
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
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

        if ($request->city_id) {
            $query->where('city_id', $request->city_id); // ✅ ispravno
        }


        if($request->guests){
            $query->where('max_persons', '>=', $request->guests);
        }

        if($request->checkin && $request->checkout){
            $query->whereDoesntHave('reservations', function ($q) use ($request){
                $q->where(function($q2) use ($request){
                    $q2->whereBetween('start_date', [$request->checkin, $request->checkout])
                       ->orWhereBetween('end_date', [$request->checkin, $request->checkout]);
                });
            });
        }

        $listings = $query->with('city')->get();

        $cities = City::orderBy('name')->get();

        return view('dashboard', compact('listings', 'cities'));
    }
}
