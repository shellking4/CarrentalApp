<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterUserRequest extends FormRequest
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
            'lastname' => 'required|max:255',
            'firstname' => 'required|max:255',
            'email' => 'email|required|max:255',
            'login' => 'required:max:255',
            'password' => 'required|confirmed'
        ];
    }

    public function messages()
    {
        return [
            'lastname.required' => 'Veuillez entrer votre nom',
            'lastname.max' => 'Votre nom contient trop de caratères',
            'firstname.required' => 'Veuillez entrer votre prénom',
            'firstname.max' => 'Votre prénom contient trop de caratères',
            'email.required' => 'Veullez entrer votre email',
            'email.email' => 'Veuillez entrer un email valide',
            'email.max' => 'Votre email contient trop de caratères',
            'login.required' => 'Veuillez entre votre login',
            'login.max' => 'Votre login contient trop de caratères',
            'password.required' => 'Veuillez spécifier votre mot de passe',
            'password.confirmed' => 'Vos mots de passe ne correspondent pas'
        ];
    }
}
