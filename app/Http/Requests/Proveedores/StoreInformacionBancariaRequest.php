<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreInformacionBancariaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //
            'nombre_banco' => ['required', 'string', 'max:50'],
            'nombre_titular' => ['required', 'string', 'max:100'],
            'cuenta' => ['required', 'string', 'max:11'],
            'clave' => ['required', 'string', 'max:18'],
            'proveedor_id' => ['required', 'integer', 'exists:proveedors,id']
        ];
    }

    public function messages(): array
    {
        return [
            'nombre_banco.required' => 'Debe especificar el nombre del banco',
            
            'nombre_titular.required' => 'Debe especificar el nombre del titular de la cuenta bancaria',
            
            'cuenta.required' => 'Debe especificar el numero de la cuenta',
            
            'clave.required' => 'Debe especificar la clave de la cuenta',

            'proveedor_id.required' => 'Se debe especificar un proveedor'
        ];
    }
}
