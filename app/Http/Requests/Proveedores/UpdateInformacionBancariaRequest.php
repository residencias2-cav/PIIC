<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateInformacionBancariaRequest extends FormRequest
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
            'nombre_banco' => ['sometimes', 'string', 'max:50'],
            'nombre_titular' => ['sometimes', 'string', 'max:100'],
            'cuenta' => ['sometimes', 'string', 'max:11'],
            'clave' => ['sometimes', 'string', 'max:18'],
            'proveedor_id' => ['sometimes', 'integer', 'exists:proveedors,id']
        ];
    }
}
