<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateOficiosProductosRequest extends FormRequest
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
            'oficios_id' => ['sometimes', 'integer', 'exists:oficios,id'],
            'fecha_firma' => ['sometimes', 'date'],
            'nombre_producto' => ['sometimes', 'string', 'max:50'],
            'monto_total' => ['sometimes', 'numeric', 'decimal:0,2', 'min:0'],
            'iva' => ['sometimes', 'numeric', 'decimal:0,2', 'min:0'],
            'folio_factura' => ['sometimes', 'string', 'max:20'],
            'factura' => ['sometimes', 'string', 'max:50'],
            'monto' => ['sometimes', 'numeric', 'decimal:0,2', 'min:0'],
            'porcentaje' => ['sometimes', 'numeric', 'decimal:0,2', 'min:0'],
            'notificacion' => ['sometimes', 'string', 'max:50'],
            'descuento' => ['sometimes', 'numeric', 'decimal:0,2', 'min:0'],
            'saldo_pendiente' => ['sometimes', 'numeric', 'decimal:0,2', 'min:0'],
            'proveedor_id' => ['sometimes', 'integer', 'exists:proveedors,id'],
            'contrato_id' => ['sometimes', 'integer', 'exists:contratos,id'],
        ];
    }
}
