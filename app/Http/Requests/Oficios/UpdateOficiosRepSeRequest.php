<?php

namespace App\Http\Requests\Oficios;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateOficiosRepSeRequest extends FormRequest
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
            'fecha_firma' => ['sometimes', 'date'],
            'contrato_id' => ['sometimes', 'integer', 'exists:contratos,id'],
            'oficio_id' => ['sometimes', 'integer', 'exists:oficios,id'],
            'proveedor_id' => ['sometimes', 'integer', 'exists:proveedors,id'],
            'empresa_id' => ['sometimes', 'integer', 'exists:empresas,id'],
            'fecha_inicio' => ['sometimes', 'date'],
            'fecha_fin' => ['sometimes', 'date'],
            'identificacion_contrato' => ['sometimes', 'string', 'max:50'],
            'ob_social_cct' => ['sometimes', 'string', 'max:50'],
            'ob_social_cts' => ['sometimes', 'string', 'max:50'],
            'repse' => ['sometimes', 'string', 'max:50'],
            'folio_actividad' => ['sometimes', 'string', 'max:20'],
            'actividad' => ['sometimes', 'string', 'max:50'],
            'vigencia' => ['sometimes', 'string', 'max:20'],
            'servicio_prestado' => ['sometimes', 'string', 'max:50'],
            'precio' => ['sometimes', 'numeric', 'decimal:0,2', 'min:0'],
            'iva' => ['sometimes', 'numeric', 'decimal:0,2', 'min:0'],
            'total' => ['sometimes', 'numeric', 'decimal:0,2', 'min:0'],
            'pago_servicio' => ['sometimes', 'numeric', 'decimal:0,2', 'min:0'],
            'correo_contacto' => ['sometimes', 'email', 'max:50'],
            'terminacion' => ['sometimes', 'string', 'max:50'],
            'contacto_contratante' => ['sometimes', 'string', 'max:50'],
            'testigo' => ['sometimes', 'string', 'max:50'],
            'productos' => ['sometimes', 'string', 'max:100'],
        ];
    }
}
