<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReviewRequest extends FormRequest
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
            'contenido' => 'required|string',
            'calificacion' => 'required|numeric|min:0|max:5',
            'user' => 'required|exists:users,id',
            'producto' => 'required|exists:productos,id'
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
            'contenido.required' => 'El contenido es obligatorio',
            'contenido.string' => 'El contenido debe ser una cadena de texto',

            'calificacion.required' => 'La calificación es obligatoria',
            'calificacion.numeric' => 'La calificación debe ser un número',
            'calificacion.min' => 'La calificación debe ser mayor o igual a 0',
            'calificacion.max' => 'La calificación debe ser menor o igual a 5',

            'user.required' => 'El usuario es obligatorio',
            'user.exists' => 'El usuario no existe en la base de datos',

            'producto.required' => 'El producto es obligatorio',
            'producto.exists' => 'El producto no existe en la base de datos'
        ];
    }
}
