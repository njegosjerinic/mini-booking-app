<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreReservationRequest;

use App\Models\Listing;
use App\Models\Reservation;
use Exception;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user_id = auth()->id();
        $reservations = Reservation::where('user_id', $user_id)->with('listing')->get();

        return view('reservations.index', compact('reservations'));

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
public function store(StoreReservationRequest $request)
{
    // Mora se uraditi na sigurniji nacin 
    try {
        Reservation::create([
            'listing_id' => $request->listing_id,
            'user_id'    => auth()->id(), // obavezno dodaš usera
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
        try {
            Reservation::findOrFail($id)->delete();
            return redirect()->route('reservations.index')->with('success', 'Rezervacije obrisana.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Greška pri brisanju rezervacije.');
        }
    }
}
