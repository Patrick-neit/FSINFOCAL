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
            'first_name' => 'required|string',
            'matricula_docente' => 'required|string',
            'phone_docente' => 'required|string|max:8',
            'direccion' => 'required|string',
            'estado' => 'required|string',
        ];
    }

    public function messages(): array
    {
        return [
            'first_name.required' => 'Nombre es Requerido',
            'matricula_docente.required' => 'Matricula es Requerido',
            'phone_docente.required' => 'Celular es Requerido',
            'phone_docente.integer' => 'Celular no debe ser mayor A 8 Numeros',
            'direccion.integer' => 'Direccion es Requerido',
            'estado' => 'Estado es Requerido',
        ];
    }
}
