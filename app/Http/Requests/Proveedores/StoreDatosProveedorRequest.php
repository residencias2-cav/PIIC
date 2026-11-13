<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreDatosProveedorRequest extends FormRequest
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
            'proveedor_id' => ['required', 'integer', 'exists:proveedors,id'],
            'folio' => ['required', 'string', 'max:11'],
            'fecha' => ['required', 'date'],
            'observaciones' => ['required', 'string', 'max:100'],
            'tiempo_entrega' => ['required', 'string', 'max:50'],
            'metodo_entrega' => ['required', 'string', 'max:50'],
            'empresa_id' => ['required', 'integer', 'exists:empresas,id'],
            'correo' => ['required', 'email', 'max:50'],
            'telefono' => ['required', 'string', 'max:20'],
            'direccion' => ['required', 'string'],
            'tipo_contrato' => ['required', 'string', 'max:50'],
        ];
    }

    public function messages(): array
    {
        return [
            'proveedor_id.required' => 'Debe seleccionar un proveedor.',
            'proveedor_id.exists' => 'El proveedor seleccionado no existe.',
            'folio.required' => 'El folio es obligatorio.',
            'fecha.required' => 'La fecha es obligatoria.',
            'fecha.date' => 'La fecha no tiene un formato válido.',
            'empresa_id.required' => 'Debe seleccionar una empresa.',
            'empresa_id.exists' => 'La empresa seleccionada no existe.',
            'correo.required' => 'El correo es obligatorio.',
            'correo.email' => 'El correo no tiene un formato válido.',
        ];
    }
}
