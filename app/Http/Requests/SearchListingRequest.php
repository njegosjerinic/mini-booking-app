<?php

namespace App\Http\Requests;

use App\Http\Requests\Common\BaseFormRequest;

class SearchListingRequest extends BaseFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'city_id' => 'integer|exists:cities,id',
            'max_persons' => 'integer|min:1',
            'start_date' => 'date|before_or_equal:end_date',
            'end_date' => 'date|after_or_equal:start_date',
        ];
    }

    public function messages()
    {
        return [
            'city_id.integer' => 'ID grada mora biti cijeli broj.',
            'city_id.exists' => 'Odabrani grad ne postoji.',
            'max_persons.integer' => 'Maksimalan broj osoba mora biti cijeli broj.',
            'max_persons.min' => 'Maksimalan broj osoba mora biti najmanje 1.',
            'start_date.date' => 'Datum početka mora biti ispravan datum.',
            'start_date.before_or_equal' => 'Datum početka mora biti prije ili jednak datumu završetka.',
            'end_date.date' => 'Datum završetka mora biti ispravan datum.',
            'end_date.after_or_equal' => 'Datum završetka mora biti nakon ili jednak datumu početka.',
        ];
    }
}
