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
            'city_id.integer' => 'The city ID must be an integer.',
            'city_id.exists' => 'The selected city does not exist.',
            'max_persons.integer' => 'Maximum persons must be an integer.',
            'max_persons.min' => 'Maximum persons must be at least 1.',
            'start_date.date' => 'Start date must be a valid date.',
            'start_date.before_or_equal' => 'Start date must be before or equal to end date.',
            'end_date.date' => 'End date must be a valid date.',
            'end_date.after_or_equal' => 'End date must be after or equal to start date.',
        ];
    }
}
