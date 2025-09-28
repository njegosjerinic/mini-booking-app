<?php

namespace App\Http\Requests;

use App\Http\Requests\Common\BaseFormRequest;

class UpdateCityRequest extends BaseFormRequest
{

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255|unique:cities,name,' . $this->city->id,
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Naziv grada je obavezan.',
            'name.string' => 'Naziv grada mora biti tekst.',
            'name.max' => 'Naziv grada ne sme biti duži od 255 karaktera.',
            'name.unique' => 'Naziv grada već postoji.',
        ];
    }
}
