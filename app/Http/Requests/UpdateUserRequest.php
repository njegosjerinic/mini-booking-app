<?php

namespace App\Http\Requests;

use App\Http\Requests\Common\BaseFormRequest;

use Illuminate\Validation\Rule;

class UpdateUserRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('users', 'name')->ignore($this->route('user')),
            ],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($this->route('user')),
            ],
            'role' => [
                'required',
                Rule::in(['admin', 'user']),
            ],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Ime je obavezno.',
            'name.string' => 'Ime mora biti tekst.',
            'name.max' => 'Ime ne smije biti duže od 255 znakova.',
            'name.unique' => 'Ime je već zauzeto.',
            'email.required' => 'Email je obavezan.',
            'email.string' => 'Email mora biti tekst.',
            'email.email' => 'Email mora biti ispravna email adresa.',
            'email.max' => 'Email ne smije biti duži od 255 znakova.',
            'email.unique' => 'Email je već zauzet.',
            'role.required' => 'Uloga je obavezna.',
            'role.in' => 'Uloga mora biti admin ili user.',
        ];
    }
}
