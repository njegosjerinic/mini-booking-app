<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateCityRequest;
use App\Http\Requests\StoreCityRequest;
use App\Models\City;
use Exception;

class CityController extends Controller
{
    // Prikaz svih gradova
    public function index()
    {
        $cities = City::all();
        return view('admin.cities.index', ['cities' => $cities]);
    }

    // Forma za dodavanje novog grada
    public function create()
    {
        return view('admin.cities.create');
    }

    // Čuvanje novog grada
    public function store(StoreCityRequest $request)
    {
        City::create($request->Validated());


        return redirect()->route('admin.cities.index')->with('success', 'Grad uspjesno napravljen');
    }

    public function show(City $city)
    {
        //
    }


    // Forma za editovanje postojećeg grada
    public function edit(string $id)
    {
        $city = City::findOrFail($id);
        return view('admin.cities.edit', compact('city'));
    }

    // Update postojećeg grada
    public function update(UpdateCityRequest $request, City $city)
    {

        $city->update($request->validated());

        return redirect()->route('admin.cities.index')->with('success', 'Grad izmjenjen uspjesno');
    }

    // Brisanje grada
    public function destroy(string $id)
    {
        try {
            $city = City::findOrFail($id);

            if ($city->listings()->exists()) {
                return redirect()->back()->with('error', 'Grad ima povezane oglase i ne može biti obrisan.');
            }

            $city->delete();

            return redirect()->back()->with('success', 'Grad obrisan uspjesno');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
