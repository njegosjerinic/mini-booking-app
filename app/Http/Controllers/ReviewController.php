<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Http\Requests\StoreReviewRequest;
use App\Models\Listing;
use Exception;
use App\Models\Review;
use Inertia\Inertia;
use Illuminate\Support\Facades\Log;

class ReviewController extends Controller
{
    public function index()
    {
        if (auth()->user()->is_admin) {
            $reviews = Review::with(['user', 'listing'])->get();
        } else {
            $reviews = Review::with(['user', 'listing'])
                ->where('user_id', auth()->id())
                ->get();
        }

        return Inertia::render('Reviews/Index', compact('reviews'));
    }


    public function create(Reservation $reservation)
    {
        $reservation->load('listing');
        return Inertia::render('Reviews/Create', compact('reservation'));
    }

    public function store(StoreReviewRequest $request)
    {
        try {
            $reservation = Reservation::findOrFail($request->reservation_id);

            // ownership check
            if ($reservation->user_id !== auth()->id()) {
                abort(403);
            }

            // finished reservation check
            if ($reservation->end_date > now()) {
                return back(303)->with('error', 'Ne možeš ostaviti recenziju prije završetka rezervacije');
            }

            $review = Review::create([
                'user_id' => auth()->id(),
                'listing_id' => $reservation->listing_id,
                'reservation_id' => $reservation->id,
                'rating' => $request->rating,
                'comment' => $request->comment,
            ]);

            return redirect()->route('reservations.index', [], 303)
                ->with('success', 'Recenzija je uspješno dodata');

        } catch (Exception $e) {
            Log::error('Error creating review: ' . $e->getMessage());

            return back(303)->with('error', 'Greška pri dodavanju recenzije');
        }
    }

    public function destroy(Review $review)
    {
        try {
            $review->delete();

            return redirect()->back()->with('success', 'Recenzija je uspješno obrisana.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Neuspješno brisanje recenzije: ' . $e->getMessage());
        }
    }

    // public function search(SearchReviewRequest $request)
    // {
    //     try {

    //     } catch (Exception $e) {

    //     }
    // }
}
