<?php 

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreListingRequest extends FormRequest
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

}
