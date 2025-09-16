<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateCityRequest;
use App\Models\City;
use Illuminate\Http\Request;

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
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $city = new City();
        $city->name = $request->name;
        $city->save();

        return redirect('/admin/cities');
    }

    public function show(City $city)
    {
        //
    }


    // Forma za editovanje postojećeg grada
    public function edit($id)
    {
        $city = City::findOrFail($id);
        return view('admin.cities.edit', ['city' => $city]);
    }

    // Update postojećeg grada
    public function update(UpdateCityRequest $request, City $city)
    {

        $city->update($request->validated());

        return redirect()->route('admin.cities.index')->with('success', 'City updated successfuly');
    }

    // Brisanje grada
    public function destroy($id)
    {
        $city = City::findOrFail($id);
        $city->delete();

        return redirect('/admin/cities');
    }
}
