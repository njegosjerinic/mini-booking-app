<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreReservationRequest;
use Inertia\Inertia;
use Illuminate\Support\Facades\Log;

use function Avifinfo\read;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            $reservations = Reservation::with('user', 'listing')->get();
        } else {
            $reservations = Reservation::where('user_id', $user->id)
                ->with('listing')
                ->get();
        }

        return Inertia::render('Reservations/Index', [
            'reservations' => $reservations
        ]);
    }


    public function store(StoreReservationRequest $request)
    {
        // Mora se uraditi na sigurniji nacin 
        try {

            $overlap = Reservation::where('listing_id', $request->listing_id)
                ->where(function ($query) use ($request) {
                    $query->whereBetween('start_date', [$request->start_date, $request->end_date])
                        ->orWhereBetween('end_date', [$request->start_date, $request->end_date])
                        ->orWhere(function ($q) use ($request) {
                            $q->where('start_date', '<', $request->start_date)
                                ->where('end_date', '>', $request->end_date);
                        });
                })
                ->exists();

            if ($overlap) {
                return back()->with('error', 'Datumi nisu dostupni');
            }

            Reservation::create([
                'listing_id' => $request->listing_id,
                'user_id' => Auth::user()->id,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
            ]);

            return redirect()
                ->route('dashboard')
                ->with('success', 'Rezervacija uspešno kreirana.');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Greška pri kreiranju rezervacije: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        $reservation = Reservation::findOrFail($id);

        if (
            auth()->user()->role !== 'admin' &&
            $reservation->user_id !== auth()->id()
        ) {
            abort(403);
        }

        $reservation->delete();

        return Inertia::location(
            auth()->user()->role === 'admin'
            ? route('admin.reservations.index')
            : route('reservations.index')
        );
    }
}
