<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FreeRentFormRequest extends FormRequest
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
            'rentTime' => 'required|gt:0|max:2'
        ];
    }

    public function messages()
    {
        return [
            'rentTime.required' => 'Veuillez entrer le temps que va durer votre location',
            'rentTime.gt' => 'Ce nombre doit être supérieur à zéro',
            'rentTime.max' => 'Nos prêts de voitures sont limités à seulement deux (02) jours'
        ];
    }
}
