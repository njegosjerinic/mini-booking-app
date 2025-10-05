<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Validation\Rule;

use App\Http\Requests\Common\BaseFormRequest;

class ProfileUpdateRequest extends BaseFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => [
                'required', 'string', 'email', 'max:255',
                Rule::unique(User::class)->ignore($this->user()->id),
            ],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Ime je obavezno.',
            'name.string' => 'Ime mora biti tekst.',
            'name.max' => 'Ime ne smije biti duže od 255 znakova.',
            'email.required' => 'Email je obavezan.',
            'email.string' => 'Email mora biti tekst.',
            'email.lowercase' => 'Email mora biti malim slovima.',
            'email.email' => 'Email mora biti ispravna email adresa.',
            'email.max' => 'Email ne smije biti duži od 255 znakova.',
            'email.unique' => 'Email je već zauzet.',
        ];
    }
}
