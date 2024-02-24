<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

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
                'stock_minimo' => 'required',
                'precio_compra' => 'required',
                'precio_unitario' => 'required',
                'precio_unitario2' => 'required',
                'precio_unitario3' => 'required',
                'precio_unitario4' => 'required',
                'precio_paquete' => 'required',
                'precio_dolar' => 'required',
            ];
        } else {
            return [];
        }
    }

    public function messages()
    {
        return [
            'codigo_producto.unique' => 'El producto ya existe.',
        ];
    }
}
