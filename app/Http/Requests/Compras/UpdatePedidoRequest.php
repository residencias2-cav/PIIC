<?php
namespace App\Http\Requests\Compras;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePedidoRequest extends FormRequest
{
    /**
     * Determine if el usuario está autorizado.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Reglas de validación.
     */
    public function rules(): array
    {
        $pedido = $this->route('pedido');

        return [
            'fecha' => [
                'required',
                'date'
            ],

            'folio' => [
                'required',
                'string',
                'max:20',
                Rule::unique('pedidos', 'folio')->ignore($pedido?->id)
            ],

            'tipo_pedido_id' => [
                'required',
                'integer',
                'exists:tipo_pedidos,id'
            ],

            'gerencia_id' => [
                'required',
                'integer',
                'exists:gerencias,id'
            ],

            'empresa_id' => [
                'required',
                'integer',
                'exists:empresas,id'
            ],

            'proyecto_id' => [
                'required',
                'integer',
                'exists:proyectos,id'
            ],

            'ubicacion_id' => [
                'required',
                'integer',
                'exists:ubicacions,id'
            ],

            'tipo_compra_id' => [
                'required',
                'integer',
                'exists:tipo_compras,id'
            ],

            'estado_id' => [
                'required',
                'integer',
                'exists:estados,id'
            ],

            'observaciones' => [
                'required',
                'string',
                'max:200'
            ],

            'monto_credito' => [
                'required',
                'integer',
                'min:0'
            ],

            'monto' => [
                'required',
                'integer',
                'min:0'
            ],
        ];
    }

    /**
     * Mensajes personalizados.
     */
    public function messages(): array
    {
        return [
            'fecha.required' => 'El campo fecha es requerido.',
            'fecha.date' => 'La fecha no tiene un formato válido.',

            'folio.required' => 'El campo folio es requerido.',
            'folio.unique' => 'Este folio ya está registrado.',

            'tipo_pedido_id.required' => 'El campo tipo de pedido es requerido.',
            'tipo_pedido_id.exists' => 'El tipo de pedido seleccionado no existe.',

            'gerencia_id.required' => 'El campo gerencia es requerido.',
            'gerencia_id.exists' => 'La gerencia seleccionada no existe.',

            'empresa_id.required' => 'El campo empresa es requerido.',
            'empresa_id.exists' => 'La empresa seleccionada no existe.',

            'proyecto_id.required' => 'El campo proyecto es requerido.',
            'proyecto_id.exists' => 'El proyecto seleccionado no existe.',

            'ubicacion_id.required' => 'El campo ubicación es requerido.',
            'ubicacion_id.exists' => 'La ubicación seleccionada no existe.',

            'tipo_compra_id.required' => 'El campo tipo de compra es requerido.',
            'tipo_compra_id.exists' => 'El tipo de compra seleccionado no existe.',

            'estado_id.required' => 'El campo estado es requerido.',
            'estado_id.exists' => 'El estado seleccionado no existe.',

            'observaciones.required' => 'El campo observaciones es requerido.',
            'observaciones.max' => 'Las observaciones no deben superar los 200 caracteres.',

            'monto_credito.required' => 'El campo monto del crédito es requerido.',
            'monto_credito.integer' => 'El monto del crédito debe ser un número entero.',
            'monto_credito.min' => 'El monto del crédito no puede ser negativo.',

            'monto.required' => 'El campo monto es requerido.',
            'monto.integer' => 'El monto debe ser un número entero.',
            'monto.min' => 'El monto no puede ser negativo.',
        ];
    }

    /**
     * Preparar datos antes de validar.
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'folio' => $this->folio
                ? strtoupper(trim($this->folio))
                : null,
        ]);
    }
}