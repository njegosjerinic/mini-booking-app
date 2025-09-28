<?php

namespace App\Http\Requests;

use App\Http\Requests\Common\BaseFormRequest;

class ShowListingRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'id' => 'required|integer|exists:listings,id',
            'start_date' => 'required|date|before_or_equal:end_date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ];
    }
    public function messages()
    {
        return [
            'id.exists' => 'Odabrani oglas ne postoji u bazi podataka.',
            'start_date.required' => 'Morate unijeti datum početka.',
            'end_date.required' => 'Morate unijeti datum završetka.',
            'end_date.after_or_equal' => 'Datum završetka mora biti isti ili nakon datuma početka.',
        ];
    }

    public function validationData()
    {
        return array_merge($this->all(), [
            'id' => $this->route('id'),
        ]);
    }
}
