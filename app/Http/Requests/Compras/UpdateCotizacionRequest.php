<?php

namespace App\Http\Requests\Compras;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCotizacionRequest extends FormRequest
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
            'pedido_id' => ['sometimes', 'integer', 'exists:pedidos,id'],
            'fecha' => ['sometimes', 'date'],
            'gerencia_id' => ['sometimes', 'integer', 'exists:gerencias,id'],
            'folio' => ['sometimes', 'string', 'max:20'],
            'folio_compra_id' => ['sometimes', 'integer', 'exists:folio_compras,id'],
            'fecha_compras' => ['sometimes', 'date'],
            'fecha_solicitud' => ['sometimes', 'date'],
            'fecha_requerido' => ['sometimes', 'date'],
            'fecha_recibido' => ['sometimes', 'date'],
            'proyecto_id' => ['sometimes', 'integer', 'exists:proyectos,id'],
            'obra_id' => ['sometimes', 'integer', 'exists:obras,id'],
            'lugar_id' => ['sometimes', 'integer', 'exists:lugars,id'],
            'tipo_cotizacion_id' => ['sometimes', 'integer', 'exists:tipo_cotizacions,id'],
            'notas' => ['sometimes', 'string', 'max:100'],
            'estado_pedido_id' => ['sometimes', 'integer', 'exists:estado_pedidos,id'],
            'created_by' => ['sometimes', 'integer'],

            'datos_cotizacion' => ['sometimes', 'array', 'min:1'],
            'datos_cotizacion.*.id' => ['sometimes', 'integer', 'exists:datos_cotizacions,id'],
            'datos_cotizacion.*.unidad_id' => ['required', 'integer', 'exists:unidads,id'],
            'datos_cotizacion.*.descripcion' => ['required', 'string', 'max:150'],
            'datos_cotizacion.*.codigo' => ['required', 'string', 'max:150'],
            'datos_cotizacion.*.entregado' => ['required', 'boolean'],
            'datos_cotizacion.*.fecha_r' => ['required', 'string', 'max:150'],
        ];
    }
}
