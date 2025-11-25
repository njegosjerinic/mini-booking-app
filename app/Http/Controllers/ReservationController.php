<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreReservationRequest;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $user_id = Auth::user()->id;
        $reservations = Reservation::query();

        if ($user->role == 'user') {
            $reservations = $reservations->where('user_id', $user_id)->with('listing')->get();
            return view('reservations.index', compact('reservations'));
        } else if ($user->role == 'admin') {
            $admin_reservations = Reservation::all();
            return view('admin.reservations.index', compact('admin_reservations'));
        }
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
                return back()->with('error','Datumi nisu dostupni');
            }

            Reservation::create([
                'listing_id' => $request->listing_id,
                'user_id'    => Auth::user()->id,
                'start_date' => $request->start_date,
                'end_date'   => $request->end_date,
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

    public function destroy(string $id)
    {
        try {
            $reservation = Reservation::findOrFail($id);
            $reservation->delete();

            return redirect()->back()->with('success', 'Rezervacija uspešno otkazana.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Greška pri otkazivanju rezervacije: ' . $e->getMessage());
        }
    }
}
