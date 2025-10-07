<?php

namespace App\Http\Requests;

use App\Http\Requests\Common\BaseFormRequest;

class ShowListingRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'start_date' => 'date|before_or_equal:end_date',
            'end_date' => 'date|after_or_equal:start_date',
        ];
    }
    public function messages()
    {
        return [
            'end_date.after_or_equal' => 'Datum završetka mora biti isti ili nakon datuma početka.',
        ];
    }

}
