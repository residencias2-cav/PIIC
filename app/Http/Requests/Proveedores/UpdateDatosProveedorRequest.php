<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateDatosProveedorRequest extends FormRequest
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
            'proveedor_id' => ['sometimes', 'integer', 'exists:proveedors,id'],
            'folio' => ['sometimes', 'string', 'max:11'],
            'fecha' => ['sometimes', 'date'],
            'observaciones' => ['sometimes', 'string', 'max:100'],
            'tiempo_entrega' => ['sometimes', 'string', 'max:50'],
            'metodo_entrega' => ['sometimes', 'string', 'max:50'],
            'empresa_id' => ['sometimes', 'integer', 'exists:empresas,id'],
            'correo' => ['sometimes', 'email', 'max:50'],
            'telefono' => ['sometimes', 'string', 'max:20'],
            'direccion' => ['sometimes', 'string'],
            'tipo_contrato' => ['sometimes', 'string', 'max:50'],
        ];
    }
}
