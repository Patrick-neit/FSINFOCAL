<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DocenteStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules():array
    {
        return [
            'nombre_completo'          => 'required|string',
            'matricula'                => 'required|string|max:24',
            'fecha_incorporacion'      => 'required|date',
            'telefono'                 => 'required|integer|max:8',
            'direccion'                => 'required|string',
            'estado'                   => 'required|char',
        ];
    }

    public function messages(): array
    {
        return [
            'nombre_completo.required' => 'Nombre es Requerido',
            'matricula.required'       => 'Matricula es Requerido',
            'fecha_incorporacion.required' => 'Fecha Incorporacion es Requerido',
            'telefono.requirerd'       => 'Celular es Requerido',
            'telefono.integer'         => 'Celular no debe ser mayor A 8 Numeros',
            'estado'                   => 'Estado es Requerido'
        ];
    }
}
