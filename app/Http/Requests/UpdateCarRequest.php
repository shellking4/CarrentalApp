<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCarRequest extends FormRequest
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
            'model' => 'required|max:255',
            'clearname' => 'required|max:255',
            'description' => 'required',
            'nbplaces' => 'required|gt:0',
            'price' => 'required|regex:/^\d+(\. \d{1,2})?$/',
            'car_image' => 'image|mimes:jpeg,jpg,png,gif,webp'
        ];
    }
    public function messages()
    {
        return [
            'model.required' => 'Le modèle est requis',
            'clearname.required' => 'L\'appelation en claire est requise',
            'description.required' => 'La description est requise',
            'nbplaces.required' => 'Le nombre de places est requis',
            'nbplaces.gt' => 'Ce nombre doit être supérieur à zéro',
            'price.required' => 'Veuillez spécifier le prix',
            'price.regex' => 'Veuillez entrer un prix correct',
            'car_image.image' => 'Votre fichier doit être une image',
            'car_image.mimes' => 'Votre fichier n\'est pas du bon type (types autorisés : jped, jpg, png, gif, webp)'
        ];
    }
}
