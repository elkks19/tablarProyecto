<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DivisaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // only allow updates if the user is logged in
        return backpack_auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nombre' => 'required|min:2|max:100',
            'simbolo' => 'required|max:10',
            'tasa' => 'required|numeric',
        ];
    }

    /**
     * Get the validation attributes that apply to the request.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            //
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'nombre.required' => 'El nombre es obligatorio',
            'nombre.min' => 'El nombre debe tener al menos :min caracteres',
            'nombre.max' => 'El nombre no puede tener más de :max caracteres',

            'simbolo.required' => 'El símbolo es obligatorio',
            'simbolo.max' => 'El símbolo no puede tener más de :max caracteres',

            'tasa.required' => 'La tasa es obligatoria',
            'tasa.numeric' => 'La tasa debe ser un número'
        ];
    }
}
