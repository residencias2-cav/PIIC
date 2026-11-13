<?php

namespace App\Http\Requests\Compras;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StorePedidoInternoRequest extends FormRequest
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
            'tipo_servicio_id' => ['required', 'integer', 'exists:tipo_servicios,id'],
            'descripcion' => ['required', 'string', 'max:100'],
            'fecha_devolucion' => ['required', 'date'],
            'fecha_entrega' => ['required', 'date'],
        ];
    }

    public function messages(): array
    {
        return [
            'pedido_id.required' => 'Debe seleccionar un pedido.',
            'pedido_id.exists' => 'El pedido seleccionado no existe.',
            'tipo_servicio_id.required' => 'Debe seleccionar un tipo de servicio.',
            'tipo_servicio_id.exists' => 'El tipo de servicio seleccionado no existe.',
            'descripcion.required' => 'La descripción es obligatoria.',
            'fecha_devolucion.required' => 'La fecha de devolución es obligatoria.',
            'fecha_devolucion.date' => 'La fecha de devolución no tiene un formato válido.',
            'fecha_entrega.required' => 'La fecha de entrega es obligatoria.',
            'fecha_entrega.date' => 'La fecha de entrega no tiene un formato válido.',
        ];
    }
}
