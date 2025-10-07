<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Http\Requests\StoreReviewRequest;

use Exception;
use App\Models\Review;

class ReviewController extends Controller
{
    public function index()
    {
        $reviews = Review::all();

        return view('admin.reviews.index', compact('reviews'));
    }


    public function create(Reservation $reservation)
    {
        $reservation->load('listing');
        return view('reviews.create', compact('reservation'));
    }

    public function store(StoreReviewRequest $request)
    {
        try {
            $reservation = Reservation::findOrFail($request->reservation_id);


            Review::create($request->all());

            return redirect()->back()->with('modal', [
                'message' => 'Recenzija je uspješno dodata',
                'type' => 'success'
            ]);
        } catch (Exception $e) {
            return redirect()->back()->with('modal', [
                'message' => 'Recenzija nije uspješno dodata',
                'type' => 'error'
            ]);
        }
    }

    public function destroy(Review $review)
    {
        try {
            $review->delete();

            return redirect()->back()->with('modal', [
                'message' => 'Recenzija je uspješno obrisana.',
                'type' => 'success'
            ]);
        } catch (Exception $e) {
            return redirect()->back()->with('modal', [
                'message' => 'Neuspješno brisanje recenzije.',
                'type' => 'error'
            ]);
        }
    }
}
