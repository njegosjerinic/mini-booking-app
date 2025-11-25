<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\City;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\UpdateCityRequest;
use App\Http\Requests\StoreCityRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CityController extends Controller
{
    // Prikaz svih gradova
    public function index()
    {
        $cities = City::withCount('listings')->get();
        return view('admin.cities.index', compact('cities'));
    }

    // Forma za dodavanje novog grada
    public function create()
    {
        return view('admin.cities.create');
    }

    // Čuvanje novog grada
    public function store(StoreCityRequest $request)
    {
        try {
            City::create($request->validated());
            return redirect()->route('admin.cities.index')->with('success', 'Grad uspjesno napravljen');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Greška pri čuvanju grada');
        }
    }


    // Forma za editovanje postojećeg grada
    public function edit($id)
    {
        try {
            $city = City::findOrFail($id);
            return view('admin.cities.edit', compact('city'));
        } catch (ModelNotFoundException $e) {
            return redirect()->back()->with('error', 'Greška pri čuvanju grada');
        }
    }

    // Update postojećeg grada
    public function update(UpdateCityRequest $request,City $city)
    {
        try {

            $city = City::findOrFail($city->id);

            $city->update($request->validated());

            return redirect()->route('admin.cities.index')->with('success', 'Grad uspjesno izmjenjen');
        } catch (ModelNotFoundException $e) {
            return redirect()->back()->with('error', 'Greška pri čuvanju grada');
        }
    }

    // Brisanje grada
    public function destroy(string $id)
    {
        try {
            $city = City::findOrFail($id);

            if ($city->listings()->exists()) {
                return redirect()->back()->with('error', 'Grad ima povezane smeštaje i ne može biti obrisan.');
            }

            $city->delete();

            return redirect()->back()->with('success', 'Grad obrisan uspjesno');
        } catch (Exception $e) {

            Log::error('Error deleting city: ' . $e->getMessage());

            return redirect()->back()->with('error', 'Greška pri brisanju grada');
        }
    }
}
