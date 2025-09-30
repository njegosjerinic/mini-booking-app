<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Listing;
use App\Models\Reservation;
use Illuminate\Http\Request;
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
        $reservations = Reservation::where('user_id', $user_id)->with('listing')->get();
        $admin_reservations = Reservation::all();


        if ($user->role == 'user') {
            return view('reservations.index', compact('reservations'));
        } else if ($user->role == 'admin') {
            return view('admin.reservations.index', compact('admin_reservations'));
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
    public function store(StoreReservationRequest $request)
    {
        // Mora se uraditi na sigurniji nacin 
        try {

            $overlap = Reservation::where('listing_id', $request->listing_id)
                ->where(function($query) use ($request) {
                    $query->whereBetween('start_date', [$request->start_date, $request->end_date])
                        ->orWhereBetween('end_date', [$request->start_date, $request->end_date])
                        ->orWhere(function($q) use ($request) {
                            $q->where('start_date', '<', $request->start_date)
                              ->where('end_date', '>', $request->end_date);
                        });
                })
                ->exists();

            if($overlap){
                return back()->with('error', 'Datumi nisu dostupni');
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
            if (Auth::user()->role == 'admin') {
                return redirect()->route('admin.reservations.index')->with('success', 'Rezervacija je obrisana');
            } elseif (Auth::user()->role == 'user') {
                return redirect()->route('reservations.index')->with('success', 'Rezervacije obrisana.');
            }
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Greška pri brisanju rezervacije.');
        }
    }
}
