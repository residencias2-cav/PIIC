<?php

namespace App\Http\Requests\Compras;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreCotizacionRequest extends FormRequest
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
            'pedido_id' => ['required', 'integer', 'exists:pedidos,id'],
            'fecha' => ['required', 'date'],
            'gerencia_id' => ['required', 'integer', 'exists:gerencias,id'],
            'folio' => ['required', 'string', 'max:20'],
            'folio_compra_id' => ['required', 'integer', 'exists:folio_compras,id'],
            'fecha_compras' => ['required', 'date'],
            'fecha_solicitud' => ['required', 'date'],
            'fecha_requerido' => ['required', 'date'],
            'fecha_recibido' => ['required', 'date'],
            'proyecto_id' => ['required', 'integer', 'exists:proyectos,id'],
            'obra_id' => ['required', 'integer', 'exists:obras,id'],
            'lugar_id' => ['required', 'integer', 'exists:lugars,id'],
            'tipo_cotizacion_id' => ['required', 'integer', 'exists:tipo_cotizacions,id'],
            'notas' => ['required', 'string', 'max:100'],
            'estado_pedido_id' => ['required', 'integer', 'exists:estado_pedidos,id'],
            'created_by' => ['required', 'integer'],

            'datos_cotizacion' => ['required', 'array', 'min:1'],
            'datos_cotizacion.*.unidad_id' => ['required', 'integer', 'exists:unidads,id'],
            'datos_cotizacion.*.descripcion' => ['required', 'string', 'max:150'],
            'datos_cotizacion.*.codigo' => ['required', 'string', 'max:150'],
            'datos_cotizacion.*.entregado' => ['required', 'boolean'],
            'datos_cotizacion.*.fecha_r' => ['required', 'string', 'max:150'],
        ];
    }

    public function messages(): array
    {
        return [
            'pedido_id.required' => 'Debe seleccionar un pedido.',
            'pedido_id.exists' => 'El pedido seleccionado no existe.',
            'fecha.required' => 'La fecha es obligatoria.',
            'fecha.date' => 'La fecha no tiene un formato válido.',
            'gerencia_id.required' => 'Debe seleccionar una gerencia.',
            'gerencia_id.exists' => 'La gerencia seleccionada no existe.',
            'folio.required' => 'El folio es obligatorio.',
            'folio_compra_id.required' => 'Debe seleccionar un folio de compra.',
            'folio_compra_id.exists' => 'El folio de compra seleccionado no existe.',
            'fecha_compras.required' => 'La fecha de compra es obligatoria.',
            'fecha_compras.date' => 'La fecha de compra no tiene un formato válido.',
            'fecha_solicitud.required' => 'La fecha de solicitud es obligatoria.',
            'fecha_solicitud.date' => 'La fecha de solicitud no tiene un formato válido.',
            'fecha_requerido.required' => 'La fecha requerida es obligatoria.',
            'fecha_requerido.date' => 'La fecha requerida no tiene un formato válido.',
            'fecha_recibido.required' => 'La fecha de recepción es obligatoria.',
            'fecha_recibido.date' => 'La fecha de recepción no tiene un formato válido.',
            'proyecto_id.required' => 'Debe seleccionar un proyecto.',
            'proyecto_id.exists' => 'El proyecto seleccionado no existe.',
            'obra_id.required' => 'Debe seleccionar una obra.',
            'obra_id.exists' => 'La obra seleccionada no existe.',
            'lugar_id.required' => 'Debe seleccionar un lugar.',
            'lugar_id.exists' => 'El lugar seleccionado no existe.',
            'tipo_cotizacion_id.required' => 'Debe seleccionar un tipo de cotización.',
            'tipo_cotizacion_id.exists' => 'El tipo de cotización seleccionado no existe.',
            'notas.required' => 'Las notas son obligatorias.',
            'estado_pedido_id.required' => 'Debe seleccionar un estado del pedido.',
            'estado_pedido_id.exists' => 'El estado del pedido seleccionado no existe.',
            'created_by.required' => 'Debe especificarse quién creó el registro.',
        ];
    }
}
