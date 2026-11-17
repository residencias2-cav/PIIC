<?php

namespace App\Http\Requests\Compras;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePedidoInternoRequest extends FormRequest
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
            'tipo_servicio_id' => ['sometimes', 'integer', 'exists:tipo_servicios,id'],
            'descripcion' => ['sometimes', 'string', 'max:100'],
            'fecha_devolucion' => ['sometimes', 'date'],
            'fecha_entrega' => ['sometimes', 'date'],
        ];
    }
}
