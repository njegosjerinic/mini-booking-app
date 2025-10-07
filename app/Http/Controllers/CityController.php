<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\City;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateCityRequest;
use App\Http\Requests\StoreCityRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CityController extends Controller
{
    // Prikaz svih gradova
    public function index()
    {
        $cities = City::all();
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
            return redirect()->route('admin.cities.index')->with('modal', [
            'message' => 'Grad uspjesno napravljen',
            'type' => 'success'
        ]);
        } catch (Exception $e) {
            return redirect()->back()->with('modal', [
            'message' => 'Greška pri čuvanju grada',
            'type' => 'error'
            ]);
        }
    }


    // Forma za editovanje postojećeg grada
    public function edit(string $id)
    {
        try {
            $city = City::findOrFail($id);
            return view('admin.cities.edit', compact('city'));
        } catch (ModelNotFoundException $e) {
            return redirect()->back()->with('modal', [
            'message' => 'Greška pri čuvanju grada',
            'type' => 'error'
            ]);
        }
    }

    // Update postojećeg grada
    public function update(UpdateCityRequest $request, string $id)
    {
        try {
            $city = City::findOrFail($id);
            $city->update($request->validated());

            return redirect()->route('admin.cities.index')->with('modal', [
                'message' => 'Grad uspjesno izmjenjen',
                'type' => 'success'
            ]);
        } catch (ModelNotFoundException $e) {
            return redirect()->back()->with('modal', [
            'message' => 'Greška pri čuvanju grada',
            'type' => 'error'
            ]);
        }
    }

    // Brisanje grada
    public function destroy(string $id)
    {
        try {
            $city = City::findOrFail($id);

            if ($city->listings()->exists() || $city->reservations()->exists()) {
                return redirect()->back()->with('modal', [
            'message' => 'Greška pri čuvanju grada',
            'type' => 'error'
            ]);
            }

            $city->delete();

            return redirect()->back()->with('modal', [
            'message' => 'Grad obrisan uspjesno',
            'type' => 'success'
            ]);
        } catch (Exception $e) {
            return redirect()->back()->with('modal', [
            'message' => 'Greška pri čuvanju grada',
            'type' => 'error'
            ]);
        }
    }
}
