<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use App\Enums\EstadosOrden;
use App\Enums\EstadosPago;
use App\Enums\EstadosEnvio;

use App\Models\Orden;
use App\Models\Pago;
use App\Models\Envio;
use App\Models\Divisa;
use App\Models\MetodoPago;

class OrdenRequest extends FormRequest
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
            //ORDEN
            'estado' => 'required',
            'user' => 'required|exists:users,id',

            //PAGO
            'montoPago' => 'required|numeric',
            'estadoPago' => 'required',
            'fechaPago' => 'required|date|before_or_equal:today',
            // 'nombreDivisa' => 'required|exists:divisas,id',
            // 'metodoPago' => 'required|exists:metodos_de_pago,id',

            //ENVIO
            'direccionEnvio' => 'required|string',
            'fechaEnvio' => 'required|date|before_or_equal:today',
            'fechaRecepcion' => 'required|date|after:fechaEnvio',
            'estadoEnvio' => 'required',
            'precioEnvio' => 'required|numeric',

            //PRODUCTOS
            'products_data' => 'required',
            'products_data.*.id' => 'required|exists:productos,id',
            'products_data.*.cantidad' => 'required|integer|min:1',
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
            'estado.required' => 'El estado de la orden es requerido',

            'user.required' => 'El usuario es requerido',
            'user.exists' => 'El usuario no existe',

            'montoPago.required' => 'El monto del pago es requerido',
            'montoPago.numeric' => 'El monto del pago debe ser un número',

            'estadoPago.required' => 'El estado del pago es requerido',

            'fechaPago.required' => 'La fecha del pago es requerida',
            'fechaPago.date' => 'La fecha del pago debe ser una fecha',
            'fechaPago.before_or_equal' => 'La fecha del pago debe ser menor o igual a la fecha actual',

            'nombreDivisa.required' => 'La divisa es requerida',
            'nombreDivisa.exists' => 'La divisa no existe',

            'metodoPago.required' => 'El método de pago es requerido',
            'metodoPago.exists' => 'El método de pago no existe',

            'direccionEnvio.required' => 'La dirección de envío es requerida',
            'direccionEnvio.string' => 'La dirección de envío debe ser una cadena',

            'fechaEnvio.required' => 'La fecha de envío es requerida',
            'fechaEnvio.date' => 'La fecha de envío debe ser una fecha',
            'fechaEnvio.before_or_equal' => 'La fecha de envío debe ser menor o igual a la fecha actual',

            'fechaRecepcion.required' => 'La fecha de recepción es requerida',
            'fechaRecepcion.date' => 'La fecha de recepción debe ser una fecha',
            'fechaRecepcion.after' => 'La fecha de recepción debe ser mayor a la fecha de envío',

            'estadoEnvio.required' => 'El estado del envío es requerido',

            'precioEnvio.required' => 'El precio del envío es requerido',
            'precioEnvio.numeric' => 'El precio del envío debe ser un número',

            'products_data.required' => 'Los productos son requeridos',

            'products_data.*.id.required' => 'El id del producto es requerido',
            'products_data.*.id.exists' => 'El producto no existe',

            'products_data.*.cantidad.required' => 'La cantidad del producto es requerida',
            'products_data.*.cantidad.integer' => 'La cantidad del producto debe ser un número entero',
            'products_data.*.cantidad.min' => 'La cantidad del producto debe ser mayor a 0'
        ];
    }
}
