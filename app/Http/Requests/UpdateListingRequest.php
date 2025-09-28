<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use App\Http\Requests\Common\BaseFormRequest;

class UpdateListingRequest extends BaseFormRequest
{
    public function rules()
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('listings', 'name')
                    ->ignore($this->route('listing')),
            ],
            'description' => 'required|string|min:10',
            'city_id' => 'required|exists:cities,id',
            'price_per_night' => 'required|numeric|min:1',
            'beds' => 'required|integer|min:1',
            'max_persons' => 'required|integer|min:1',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Ime je obavezno.',
            'name.string' => 'Ime mora biti tekst.',
            'name.max' => 'Ime ne smije biti duže od 255 znakova.',
            'email.required' => 'Email je obavezan.',
            'email.string' => 'Email mora biti tekst.',
            'email.lowercase' => 'Email mora biti malim slovima.',
            'email.email' => 'Email mora biti ispravna email adresa.',
            'email.max' => 'Email ne smije biti duži od 255 znakova.',
            'email.unique' => 'Email je već zauzet.',
        ];
    }
}
