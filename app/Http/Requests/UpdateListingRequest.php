<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateListingRequest extends FormRequest
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
}
