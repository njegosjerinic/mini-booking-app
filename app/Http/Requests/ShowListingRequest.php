<?php

namespace App\Http\Requests;

use App\Http\Requests\Common\BaseFormRequest;

class ShowListingRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'id' => 'integer|exists:listings,id',
            'start_date' => 'date|before_or_equal:end_date',
            'end_date' => 'date|after_or_equal:start_date',
        ];
    }
    public function messages()
    {
        return [
            'id.exists' => 'Odabrani oglas ne postoji u bazi podataka.',
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
