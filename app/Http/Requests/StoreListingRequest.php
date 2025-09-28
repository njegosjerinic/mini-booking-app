<?php

namespace App\Http\Requests;

use App\Http\Requests\Common\BaseFormRequest;

class StoreListingRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'city_id' => 'required|exists:cities,id',
            'price_per_night' => 'required|numeric|min:0',
            'beds' => 'required|integer|min:1',
            'max_persons' => 'required|integer|min:1',
            'image_path' => 'nullable',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Ime je obavezno.',
            'name.string' => 'Ime mora biti tekst.',
            'name.max' => 'Ime ne smije biti duže od 255 znakova.',

            'description.string' => 'Opis mora biti tekst.',

            'city_id.required' => 'Grad je obavezan.',
            'city_id.exists' => 'Odabrani grad ne postoji.',

            'price_per_night.required' => 'Cijena po noći je obavezna.',
            'price_per_night.numeric' => 'Cijena po noći mora biti broj.',
            'price_per_night.min' => 'Cijena po noći mora biti najmanje 0.',

            'beds.required' => 'Broj kreveta je obavezan.',
            'beds.integer' => 'Broj kreveta mora biti cijeli broj.',
            'beds.min' => 'Broj kreveta mora biti najmanje 1.',

            'max_persons.required' => 'Maksimalan broj osoba je obavezan.',
            'max_persons.integer' => 'Maksimalan broj osoba mora biti cijeli broj.',
            'max_persons.min' => 'Maksimalan broj osoba mora biti najmanje 1.',
        ];
    }
}
