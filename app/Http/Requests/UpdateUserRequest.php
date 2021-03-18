<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'lastname' => 'max:255',
            'firstname' => 'max:255',
            'email' => 'email|max:255',
            'login' => 'max:255',
        ];
    }

    public function messages()
    {
        return [
            'lastname.max' => 'Votre nom contient trop de caratères',
            'firstname.max' => 'Votre prénom contient trop de caratères',
            'email.email' => 'Veuillez entrer un email valide',
            'email.max' => 'Votre email contient trop de caratères',
            'login.max' => 'Votre login contient trop de caratères'
        ];
    }
}
