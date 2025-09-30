<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Http\Requests\StoreReviewRequest;

use Exception;
use App\Models\Review;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reviews = Review::all();

        return view('admin.reviews.index', compact('reviews'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Reservation $reservation)
    {
        $reservation->load('listing');
        return view('reviews.create', compact('reservation'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreReviewRequest $request)
    {
        try {
            $reservation = Reservation::findOrFail($request->reservation_id);


            Review::create($request->all());

            return redirect()->back()->with('success', 'Recenzija je uspješno dodata');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Recenzija nije uspješno dodata');
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
    public function destroy(Review $review)
    {
        try {
            $review->delete();

            return redirect()->back()->with('success', 'Recenzija je uspješno obrisana.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Neuspješno brisanje recenzije.');
        }
    }
}
