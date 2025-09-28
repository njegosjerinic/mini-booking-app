<?php

namespace App\Http\Requests;

use App\Http\Requests\Common\BaseFormRequest;

class StoreReservationRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'listing_id' => 'required|exists:listings,id',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after:start_date'
        ];
    }

    public function messages()
    {
        return [
            'listing_id.required' => 'Listing je obavezan.',
            'listing_id.exists' => 'Odabrani listing ne postoji.',

            'start_date.required' => 'Datum početka je obavezan.',
            'start_date.date' => 'Datum početka mora biti ispravan datum.',
            'start_date.after_or_equal' => 'Datum početka mora biti danas ili kasnije.',

            'end_date.required' => 'Datum završetka je obavezan.',
            'end_date.date' => 'Datum završetka mora biti ispravan datum.',
            'end_date.after' => 'Datum završetka mora biti nakon datuma početka.',
        ];
    }
}
