<?php

namespace App\Http\Requests\Oficios;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreOficiosProductosRequest extends FormRequest
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
            'oficios_id' => ['required', 'integer', 'exists:oficios,id'],
            'fecha_firma' => ['required', 'date'],
            'nombre_producto' => ['required', 'string', 'max:50'],
            'monto_total' => ['required', 'numeric', 'decimal:0,2', 'min:0'],
            'iva' => ['required', 'numeric', 'decimal:0,2', 'min:0'],
            'folio_factura' => ['required', 'string', 'max:20'],
            'factura' => ['required', 'string', 'max:50'],
            'monto' => ['required', 'numeric', 'decimal:0,2', 'min:0'],
            'porcentaje' => ['required', 'numeric', 'decimal:0,2', 'min:0'],
            'notificacion' => ['required', 'string', 'max:50'],
            'descuento' => ['required', 'numeric', 'decimal:0,2', 'min:0'],
            'saldo_pendiente' => ['required', 'numeric', 'decimal:0,2', 'min:0'],
            'proveedor_id' => ['required', 'integer', 'exists:proveedors,id'],
            'contrato_id' => ['required', 'integer', 'exists:contratos,id'],
        ];
    }

    public function messages(): array
    {
        return [
            'oficios_id.required' => 'Debe seleccionar un oficio.',
            'oficios_id.exists' => 'El oficio seleccionado no existe.',
            'fecha_firma.required' => 'La fecha de firma es obligatoria.',
            'fecha_firma.date' => 'La fecha de firma no tiene un formato válido.',
            'nombre_producto.required' => 'El nombre del producto es obligatorio.',
            'monto_total.required' => 'El monto total es obligatorio.',
            'iva.required' => 'El IVA es obligatorio.',
            'folio_factura.required' => 'El folio de factura es obligatorio.',
            'factura.required' => 'La factura es obligatoria.',
            'monto.required' => 'El monto es obligatorio.',
            'porcentaje.required' => 'El porcentaje es obligatorio.',
            'notificacion.required' => 'La notificación es obligatoria.',
            'descuento.required' => 'El descuento es obligatorio.',
            'saldo_pendiente.required' => 'El saldo pendiente es obligatorio.',
            'proveedor_id.required' => 'Debe seleccionar un proveedor.',
            'proveedor_id.exists' => 'El proveedor seleccionado no existe.',
            'contrato_id.required' => 'Debe seleccionar un contrato.',
            'contrato_id.exists' => 'El contrato seleccionado no existe.',
        ];
    }
}
