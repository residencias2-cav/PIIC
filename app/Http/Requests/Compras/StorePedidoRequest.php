<?php
namespace App\Http\Requests\Compras;

use App\Models\Catalogos\TipoPedido;
use Illuminate\Foundation\Http\FormRequest;

class StorePedidoRequest extends FormRequest
{
    /**
     * Determinar si el usuario está autorizado.
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
        // Obtener el tipo de pedido seleccionado.
        $tipoPedido = TipoPedido::find($this->input('tipo_pedido_id'));

        $nombreTipo = strtolower(trim($tipoPedido?->nombre ?? ''));

        // Identificar el tipo de pedido.
        $esInterno = $nombreTipo === 'pedido int';
        $esAlm = $nombreTipo === 'pedido alm';

        $rules = [

            // DATOS GENERALES
            'fecha' => [
                'required',
                'date',
            ],

            'folio' => [
                'required',
                'string',
                'max:20',
                'unique:pedidos,folio',
            ],

            'tipo_pedido_id' => [
                'required',
                'integer',
                'exists:tipo_pedidos,id',
            ],

            'gerencia_id' => [
                'required',
                'integer',
                'exists:gerencias,id',
            ],

            'empresa_id' => [
                'required',
                'integer',
                'exists:empresas,id',
            ],

            'proyecto_id' => [
                'required',
                'integer',
                'exists:proyectos,id',
            ],

            'ubicacion_id' => [
                'required',
                'integer',
                'exists:ubicacions,id',
            ],

            'tipo_compra_id' => [
                'required',
                'integer',
                'exists:tipo_compras,id',
            ],

            'estado_id' => [
                'required',
                'integer',
                'exists:estados,id',
            ],

            'observaciones' => [
                'required',
                'string',
                'max:200',
            ],

            'monto_credito' => [
                'required',
                'integer',
                'min:0',
            ],

            'monto' => [
                'required',
                'integer',
                'min:0',
            ],
        ];


        // ==========================================
        // PEDIDO INTERNO
        // ==========================================

        if ($esInterno) {

            $rules = array_merge($rules, [

                'pedido_interno' => [
                    'required',
                    'array',
                ],

                'pedido_interno.tipo_servicio_id' => [
                    'required',
                    'integer',
                    'exists:tipo_servicios,id',
                ],

                'pedido_interno.descripcion' => [
                    'required',
                    'string',
                    'max:100',
                ],

                'pedido_interno.fecha_devolucion' => [
                    'required',
                    'date',
                ],

                'pedido_interno.fecha_entrega' => [
                    'required',
                    'date',
                ],

            ]);

        } else {

            // No permitir datos de pedido interno
            // cuando el tipo seleccionado sea diferente.
            $rules['pedido_interno'] = [
                'prohibited',
            ];
        }


        // ==========================================
        // PEDIDO ALM
        // ==========================================

        if ($esAlm) {

            $rules = array_merge($rules, [

                'detalles' => [
                    'required',
                    'array',
                    'min:1',
                ],

                'detalles.*.partida' => [
                    'required',
                    'integer',
                    'min:1',
                ],

                'detalles.*.cantidad' => [
                    'required',
                    'integer',
                    'min:1',
                ],

                'detalles.*.unidad_id' => [
                    'required',
                    'integer',
                    'exists:unidads,id',
                ],

                'detalles.*.descripcion' => [
                    'required',
                    'string',
                    'max:100',
                ],

                'detalles.*.uso' => [
                    'required',
                    'string',
                ],

                'detalles.*.credito' => [
                    'required',
                    'boolean',
                ],

                'detalles.*.fecha_pago' => [
                    'required',
                    'date',
                ],

                'detalles.*.codigo' => [
                    'required',
                    'string',
                ],

            ]);

        } else {

            // No permitir partidas ALM
            // cuando el tipo seleccionado sea diferente.
            $rules['detalles'] = [
                'prohibited',
            ];
        }

        return $rules;
    }

    /**
     * Mensajes personalizados.
     */
    public function messages(): array
    {
        return [

            // DATOS GENERALES
            'fecha.required' => 'El campo fecha es requerido.',
            'fecha.date' => 'La fecha no tiene un formato válido.',

            'folio.required' => 'El campo folio es requerido.',
            'folio.unique' => 'Este folio ya está registrado.',
            'folio.max' => 'El folio no debe superar los 20 caracteres.',

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


            // PEDIDO INTERNO
            'pedido_interno.required' => 'La información del pedido interno es requerida.',
            'pedido_interno.array' => 'La información del pedido interno no tiene un formato válido.',

            'pedido_interno.tipo_servicio_id.required' => 'Selecciona un tipo de servicio.',
            'pedido_interno.tipo_servicio_id.exists' => 'El tipo de servicio seleccionado no existe.',

            'pedido_interno.descripcion.required' => 'La descripción del pedido interno es requerida.',
            'pedido_interno.descripcion.max' => 'La descripción no debe superar los 100 caracteres.',

            'pedido_interno.fecha_devolucion.required' => 'La fecha de devolución es requerida.',
            'pedido_interno.fecha_devolucion.date' => 'La fecha de devolución no es válida.',

            'pedido_interno.fecha_entrega.required' => 'La fecha de entrega es requerida.',
            'pedido_interno.fecha_entrega.date' => 'La fecha de entrega no es válida.',


            // PEDIDO ALM
            'detalles.required' => 'Debes agregar al menos una partida al pedido ALM.',
            'detalles.array' => 'Las partidas deben tener un formato válido.',
            'detalles.min' => 'Debes agregar al menos una partida.',

            'detalles.*.partida.required' => 'El número de partida es requerido.',
            'detalles.*.partida.integer' => 'El número de partida debe ser entero.',
            'detalles.*.partida.min' => 'El número de partida debe ser mayor que cero.',

            'detalles.*.cantidad.required' => 'La cantidad es requerida.',
            'detalles.*.cantidad.integer' => 'La cantidad debe ser un número entero.',
            'detalles.*.cantidad.min' => 'La cantidad debe ser mayor que cero.',

            'detalles.*.unidad_id.required' => 'Selecciona una unidad.',
            'detalles.*.unidad_id.exists' => 'La unidad seleccionada no existe.',

            'detalles.*.descripcion.required' => 'La descripción de la partida es requerida.',
            'detalles.*.descripcion.max' => 'La descripción no debe superar los 100 caracteres.',

            'detalles.*.uso.required' => 'El uso de la partida es requerido.',

            'detalles.*.credito.required' => 'Indica si la partida es a crédito.',
            'detalles.*.credito.boolean' => 'El valor de crédito no es válido.',

            'detalles.*.fecha_pago.required' => 'La fecha de pago es requerida.',
            'detalles.*.fecha_pago.date' => 'La fecha de pago no es válida.',

            'detalles.*.codigo.required' => 'El código de la partida es requerido.',

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