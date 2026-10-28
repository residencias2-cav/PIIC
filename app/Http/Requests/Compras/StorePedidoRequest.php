<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StorePedidoRequest extends FormRequest
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
            'folio' => ['required', 'string', 'max:20', 'unique:pedidos, folio'],
            'tipo_pedido_id' => ['required', 'int', 'exists:pedidos,id'],
            'gerencia_id' => ['required', 'int', 'exists:gerencias,id'],
            'empresa_id' => ['required', 'int', 'exists:empresas,id'],
            'proyecto_id' => ['required', 'int', 'exists:proyectos,id'],
            'ubicacion_id' => ['required', 'int', 'exists:ubicacion,id'],
            'tipo_compra_id' => ['required', 'int', 'exists:tipo_compras,id'],
            'estado_id' => ['required', 'int', 'exists:estado,id'],
            'observaciones' => ['required', 'string', 'max: 200'],
            'monto_credito' => ['required', 'decimal:2', 'min: 0'],
            'monto' => ['required', 'decimal:2', 'min: 0'],
            'created_by' => ['required', 'integer'],
        ];
    }

    public function messages():array
    {
        return [
            'fecha.required' => 'El campo fecha es requerido',
            'fecha.date' => 'La fecha no tiene formato valido.',

            'folio.required' => 'El campo folio es requerido',

            'tipo_pedido_id.required' => 'El campo tipo de pedido es requerido',

            'gerencia_id.required' => 'El campo gerencia es requerido',

            'empresa_id.required' => 'El campo empresa es requerido',

            'proyecto_id.required' => 'El campo proyecto es requerido',

            'ubicacion_id.required' => 'El campo ubicacion es requerido',

            'tipo_compra_id.required' => 'El campo tipo de compra es requerido',

            'estado_id.required' => 'El campo estado es requerido',

            'observaciones.required' => 'El campo observaciones es requerido',

            'monto_credito.required' => 'El campo monto del credito es requerido',

            'monto.required' => 'El campo monto es requerido',
        ];
    }

    public function prepareForValidation()
    {
        $this->merge([
            'folio' => $this->folio ? strtoupper(trim($this->folio)): null,
        ]);
    }
}
