<?php

namespace App\Http\Requests\Compras;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePedidoRequest extends FormRequest
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
            'fecha' => ['required', 'date'],
            'folio' => ['required', 'string', 'max:20', 'unique:pedidos, folio,'],
            'tipo_pedido_id' => ['required', 'exists:tipos_pedidos,id'],
            'gerencia_id' => ['required', 'exists:gerencias,id'],
            'empresa_id' => ['required', 'exists:empresas,id'],
            'proyecto_id' => ['required', 'exists:proyectos,id'],
            'ubicacion_id' => ['required', 'exists:ubicaciones,id'],
            'tipo_compra_id' => ['required', 'exists:tipos_compras,id'],
            'estado_id' => ['required', 'exists:estados,id'],
            'observaciones' => ['required', 'string', 'max: 200'],
            'monto_credito' => ['required', 'decimal:2', 'min: 0'],
            'monto' => ['required', 'decimal:2', 'min: 0'],
        ];
    }
}
