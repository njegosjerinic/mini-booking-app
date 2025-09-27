<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReviewRequest;
use App\Models\Listing;
use App\Models\Reservation;
use Illuminate\Http\Request;

use App\Models\Review;
use Exception;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Reservation $reservation, Listing $listing)
    {
        $reservation->load('listing');
        return view('reviews.create', compact('reservation'));
    } 

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreReviewRequest $request)
    {
        try{
            Review::create(array_merge(
            $request->validated(),
                    ['user_id' => auth()->id()]
            ));


            return redirect()->back()->with('success' , 'Recenzija je uspjesno dodata');
        }catch(Exception $e){
            return  redirect()->back()->with('error' , 'Recenzija nije uspjesno dodata');
        }
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
}
