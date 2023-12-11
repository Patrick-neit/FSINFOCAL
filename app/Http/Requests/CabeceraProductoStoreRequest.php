<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class CabeceraProductoStoreRequest extends FormRequest
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

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(responseJSON($validator->errors()->first(), $validator->errors()->all(), 422));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        if (empty($this->producto_id)) {
            return [
                'unidad_medida' => 'required',
                'marca_id' => 'required',
                'codigo_producto' => 'required|unique:cabecera_productos,codigo_producto',
                'nombre_producto' => 'required',
                'categoria' => 'required',
                'tipo_producto' => 'required',
                'sub_familia' => 'required',
                'homologacion' => 'required',
                'estado' => 'required',
                'stock_minimo' => 'required|decimal:5',
                'stock_actual' => 'decimal:5',
                'precio_compra' => 'required|decimal:5',
                'precio_unitarioo' => 'required|decimal:5',
                'precio_unitario2' => 'required|decimal:5',
                'precio_unitario3' => 'required|decimal:5',
                'precio_unitario4' => 'required|decimal:5',
                'precio_paquete' => 'required|decimal:5',
                'precio_dolar' => 'required|decimal:5',
            ];
        } else {
            return [
                'stock_minimo' => 'decimal:5',
                'stock_actual' => 'decimal:5',
                'precio_compra' => 'decimal:5',
                'precio_unitarioo' => 'decimal:5',
                'precio_unitario2' => 'decimal:5',
                'precio_unitario3' => 'decimal:5',
                'precio_unitario4' => 'decimal:5',
                'precio_paquete' => 'decimal:5',
                'precio_dolar' => 'decimal:5',
            ];
        }
    }

    public function messages()
    {
        return [
            'codigo_producto.unique' => 'El producto ya existe.',
            'stock_minimo.decimal' => 'El :attribute tiene que tener 5 decimales',
            'stock_actual.decimal' => 'El :attribute tiene que tener 5 decimales',
            'precio_compra.decimal' => 'El :attribute tiene que tener 5 decimales',
            'precio_unitarioo.decimal' => 'El :attribute tiene que tener 5 decimales',
            'precio_unitario2.decimal' => 'El :attribute tiene que tener 5 decimales',
            'precio_unitario3.decimal' => 'El :attribute tiene que tener 5 decimales',
            'precio_unitario4.decimal' => 'El :attribute tiene que tener 5 decimales',
            'precio_paquete.decimal' => 'El :attribute tiene que tener 5 decimales',
            'precio_dolar.decimal' => 'El :attribute tiene que tener 5 decimales',
        ];
    }
}
