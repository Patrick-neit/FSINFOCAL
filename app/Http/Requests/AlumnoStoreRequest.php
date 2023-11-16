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
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'ci_alumno' => 'required|string',
            'fecha_nacimiento_alumno' => 'required|date',
            'domicilio_alumno' => 'required|string',
            'phone' => 'required|string|max:8',
            'email' => 'required|email',

        ];
    }

    public function messages(): array
    {
        return [
            'first_name.required' => 'Nombre es Requerido',
            'last_name.required' => 'Apellido es Requerido',
            'ci_alumno.required' => 'C.I es Requerido',
            'fecha_nacimiento_alumno.required' => 'Fecha Nacimiento es Requerido',
            'domicilio_alumno.required' => 'Domicilio es Requerido',
            'phone.required' => 'Celular es Requerido',
            'email' => 'Email es Requerido',
        ];
    }
}
