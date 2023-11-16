<?php

namespace App\Http\Requests\ConfImp;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class StoreConfImpRequest extends FormRequest
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
        throw new HttpResponseException(responseJSON('Error de validación', $validator->errors(), 422));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'nombre_sistema' => 'required|string',
            'ambiente' => 'required|integer',
            'modalidad' => 'required|integer',
            'codigo_sistema' => 'required|string',
            'token_sistema' => 'required|string',
            'empresa_id' => [
                'required',
                Rule::unique('configuraciones_impuestos')->where(function ($query) {
                    return $query->where('id', auth()->user()->empresas[0]->id);
                })
            ],
            'estado' => 'required|integer',
        ];
    }
}
