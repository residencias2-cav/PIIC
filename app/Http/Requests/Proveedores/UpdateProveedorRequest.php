<?php

namespace App\Http\Requests\Proveedores;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\Proveedores\Proveedor;

class UpdateProveedorRequest extends FormRequest
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
            'nombre' => ['sometimes', 'string', 'max:100'],
            'razon_social' => ['sometimes', 'string', 'max:100'],
            'curp' => ['sometimes', 'string', 'max:18', Rule::unique(Proveedor::class, 'curp')->ignore($this->Route('proveedor'))],
            'rfc' => ['sometimes', 'string', 'max:13', Rule::unique(Proveedor::class, 'rfc')->ignore($this->Route('proveedor'))],
            'area' => ['sometimes', 'string', 'max:30'],
            'desc_bs' => ['sometimes', 'string', 'max:100'],
            'vigencia_sat' => ['sometimes', 'date'],
            'inf_credito_id' => ['sometimes', 'integer', 'exists:inf_creditito,id'],
            'inf_contrato_id' => ['sometimes', 'integer', 'exists:inf_contrato,id'],
            'inf_impuestos' => ['sometimes', 'string', 'max:250'],
            'registrado' => ['sometimes', 'boolean'],   
        ];
    }
}
