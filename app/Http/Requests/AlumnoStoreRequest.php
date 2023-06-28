<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AlumnoStoreRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'nombre'    => 'required|string',
            'apellido'  => 'required|string',
            'ci'        => 'required|string',
            'fecha_nacimiento' => 'required|date',
            'domicilio' => 'required|string',
            'celular'   => 'required|integer|max:8',
            'email'     => 'required|email',

        ];
    }

    public function messages(): array
    {
        return [
            'nombre.required'   => 'Nombre es Requerido',
            'apellido.required' => 'Apellido es Requerido',
            'ci.required'       => 'C.I es Requerido',
            'fecha_nacimiento.required' => 'Fecha Nacimiento es Requerido',
            'domicilio.required' => 'Domicilio es Requerido',
            'celular.requirerd' => 'Celular es Requerido',
            'celular.integer'   => 'Celular no debe ser mayor A 8 Numeros',
            'email'             => 'Email es Requerido'
        ];
    }
}
