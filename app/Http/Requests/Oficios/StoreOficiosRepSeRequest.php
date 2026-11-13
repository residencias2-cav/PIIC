<?php

namespace App\Http\Requests\Oficios;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreOficiosRepSeRequest extends FormRequest
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
            'fecha_firma' => ['required', 'date'],
            'contrato_id' => ['required', 'integer', 'exists:contratos,id'],
            'oficio_id' => ['required', 'integer', 'exists:oficios,id'],
            'proveedor_id' => ['required', 'integer', 'exists:proveedors,id'],
            'empresa_id' => ['required', 'integer', 'exists:empresas,id'],
            'fecha_inicio' => ['required', 'date'],
            'fecha_fin' => ['required', 'date'],
            'identificacion_contrato' => ['required', 'string', 'max:50'],
            'ob_social_cct' => ['required', 'string', 'max:50'],
            'ob_social_cts' => ['required', 'string', 'max:50'],
            'repse' => ['required', 'string', 'max:50'],
            'folio_actividad' => ['required', 'string', 'max:20'],
            'actividad' => ['required', 'string', 'max:50'],
            'vigencia' => ['required', 'string', 'max:20'],
            'servicio_prestado' => ['required', 'string', 'max:50'],
            'precio' => ['required', 'numeric', 'decimal:0,2', 'min:0'],
            'iva' => ['required', 'numeric', 'decimal:0,2', 'min:0'],
            'total' => ['required', 'numeric', 'decimal:0,2', 'min:0'],
            'pago_servicio' => ['required', 'numeric', 'decimal:0,2', 'min:0'],
            'correo_contacto' => ['required', 'email', 'max:50'],
            'terminacion' => ['required', 'string', 'max:50'],
            'contacto_contratante' => ['required', 'string', 'max:50'],
            'testigo' => ['required', 'string', 'max:50'],
            'productos' => ['required', 'string', 'max:100'],
        ];
    }

    public function messages(): array
    {
        return [
            'fecha_firma.required' => 'La fecha de firma es obligatoria.',
            'contrato_id.required' => 'Debe seleccionar un contrato.',
            'contrato_id.exists' => 'El contrato seleccionado no existe.',
            'oficio_id.required' => 'Debe seleccionar un oficio.',
            'oficio_id.exists' => 'El oficio seleccionado no existe.',
            'proveedor_id.required' => 'Debe seleccionar un proveedor.',
            'proveedor_id.exists' => 'El proveedor seleccionado no existe.',
            'empresa_id.required' => 'Debe seleccionar una empresa.',
            'empresa_id.exists' => 'La empresa seleccionada no existe.',
            'fecha_inicio.required' => 'La fecha de inicio es obligatoria.',
            'fecha_fin.required' => 'La fecha de fin es obligatoria.',
            'correo_contacto.required' => 'El correo de contacto es obligatorio.',
            'correo_contacto.email' => 'El correo de contacto no tiene un formato válido.',
        ];
    }
}
