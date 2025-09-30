<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Common\BaseFormRequest;

class StoreReviewRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'listing_id' => 'required|exists:listings,id',
            'reservation_id' => 'required|exists:reservations,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:500',
        ];
    }

    public function messages()
    {
        return [
            'listing_id.required' => 'Listing je obavezan.',
            'listing_id.exists' => 'Odabrani listing ne postoji.',

            'reservation_id.required' => 'Rezervacija je obavezna.',
            'reservation_id.exists' => 'Odabrana rezervacija ne postoji.',

            'rating.required' => 'Ocena je obavezna.',
            'rating.integer' => 'Ocena mora biti broj.',
            'rating.min' => 'Ocena mora biti najmanje 1.',
            'rating.max' => 'Ocena ne može biti veća od 5.',

            'comment.required' => 'Komentar je obavezan.',
            'comment.string' => 'Komentar mora biti tekst.',
            'comment.max' => 'Komentar ne može imati više od 500 karaktera.',
        ];
    }

    public function validationData()
    {
        return array_merge(parent::validationData(), [
            'user_id' => Auth::user()->id,
        ]);
    }
}
