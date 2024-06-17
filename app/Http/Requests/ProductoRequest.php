<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // only allmergeow updates if the user is logged in
        return backpack_auth()->check();
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation(): void
    {
        // could also use $this->replace() if desired
        $this->merge([
            "categorias" => json_decode($this->categorias),
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nombre' => 'required|min:2|max:120',
            'descripcion' => 'nullable',
            'precio' => 'required|numeric|between:0,9999999999999.99',
            'categorias' => 'required|exists:categorias,id',
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

            'precio.required' => 'El precio es obligatorio',
            'precio.numeric' => 'El precio debe ser un número',
            'precio.between' => 'El precio debe estar entre :min y :max',

            'categorias.required' => 'Por lo menos debe seleccionar una categoria',
            'categorias.exists' => 'Alguna de las categorias seleccionadas no existe en la base de datos'
        ];
    }
}
