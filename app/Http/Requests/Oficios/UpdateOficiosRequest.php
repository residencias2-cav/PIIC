<?php
namespace App\Http\Requests\Oficios;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateOficiosRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $oficio = $this->route('oficios');

        $oficioId = $oficio instanceof \App\Models\Oficios\Oficios
            ? $oficio->id
            : $oficio;

        return [

            // INFORMACIÓN GENERAL

            'folio' => [
                'sometimes',
                'required',
                'string',
                'max:50',
                Rule::unique('oficios', 'folio')->ignore($oficioId)
            ],

            'fecha' => ['sometimes', 'required', 'date'],

            'asunto' => ['required', 'string', 'max:200'],
            'cuerpo' => ['required', 'string'],

            'tipo_oficio_id' => [
                'required',
                'integer',
                'exists:tipo_oficios,id'
            ],

            'estado_id' => [
                'required',
                'integer',
                'exists:estados,id'
            ],

            'observaciones' => ['nullable', 'string', 'max:200'],
            'cargos_generales' => ['nullable', 'string', 'max:150'],


            // DETALLE REPSE

            'repse' => ['nullable', 'array'],

            'repse.fecha_firma' => ['required_with:repse', 'date'],
            'repse.contrato_id' => ['required_with:repse', 'integer', 'exists:contratos,id'],
            'repse.proveedor_id' => ['required_with:repse', 'integer', 'exists:proveedores,id'],
            'repse.empresa_id' => ['required_with:repse', 'integer', 'exists:empresas,id'],
            'repse.fecha_inicio' => ['required_with:repse', 'date'],
            'repse.fecha_fin' => ['required_with:repse', 'date'],
            'repse.identificacion_contrato' => ['required_with:repse', 'string', 'max:50'],
            'repse.ob_social_ctt' => ['required_with:repse', 'string', 'max:50'],
            'repse.ob_social_cts' => ['required_with:repse', 'string', 'max:50'],
            'repse.repse' => ['required_with:repse', 'string', 'max:50'],
            'repse.folio_actividad' => ['required_with:repse', 'string', 'max:20'],
            'repse.actividad' => ['required_with:repse', 'string', 'max:50'],
            'repse.vigencia' => ['required_with:repse', 'string', 'max:20'],
            'repse.servicio_prestado' => ['required_with:repse', 'string', 'max:50'],
            'repse.precio' => ['required_with:repse', 'numeric', 'min:0'],
            'repse.iva' => ['required_with:repse', 'numeric', 'min:0'],
            'repse.total' => ['required_with:repse', 'numeric', 'min:0'],
            'repse.pago_servicio' => ['required_with:repse', 'numeric', 'min:0'],
            'repse.correo_contacto' => ['required_with:repse', 'email', 'max:50'],
            'repse.terminacion' => ['required_with:repse', 'string', 'max:50'],
            'repse.contacto_contratante' => ['required_with:repse', 'string', 'max:50'],
            'repse.testigo' => ['required_with:repse', 'string', 'max:50'],
            'repse.productos' => ['required_with:repse', 'string', 'max:100'],


            // DETALLE PRODUCTOS

            'productos' => ['nullable', 'array'],

            'productos.fecha_firma' => ['required_with:productos', 'date'],
            'productos.nombre_producto' => ['required_with:productos', 'string', 'max:50'],
            'productos.monto_total' => ['required_with:productos', 'numeric', 'min:0'],
            'productos.iva' => ['required_with:productos', 'numeric', 'min:0'],
            'productos.folio_factura' => ['required_with:productos', 'string', 'max:20'],
            'productos.factura' => ['required_with:productos', 'string', 'max:50'],
            'productos.monto' => ['required_with:productos', 'numeric', 'min:0'],
            'productos.porcentaje' => ['required_with:productos', 'numeric', 'min:0'],
            'productos.notificacion' => ['required_with:productos', 'string', 'max:50'],
            'productos.descuento' => ['required_with:productos', 'numeric', 'min:0'],
            'productos.saldo_pendiente' => ['required_with:productos', 'numeric', 'min:0'],
            'productos.proveedor_id' => ['required_with:productos', 'integer', 'exists:proveedores,id'],
            'productos.contrato_id' => ['required_with:productos', 'integer', 'exists:contratos,id'],


            // DETALLE COMISIONES

            'comisiones' => ['nullable', 'array'],

            'comisiones.dias' => ['required_with:comisiones', 'integer', 'min:1'],
            'comisiones.comision' => ['required_with:comisiones', 'string'],
            'comisiones.ciudad_destino' => ['required_with:comisiones', 'string'],
            'comisiones.fecha_hora_inicio' => ['required_with:comisiones', 'date'],
            'comisiones.fecha_hora_termino' => ['required_with:comisiones', 'date'],


            // DETALLE RUTAS

            'rutas' => ['nullable', 'array'],

            'rutas.folio_ac' => ['required_with:rutas', 'string', 'max:20'],
            'rutas.ruta' => ['required_with:rutas', 'string', 'max:100'],
            'rutas.trabajador_id' => ['required_with:rutas', 'integer', 'exists:trabajadores,id'],
            'rutas.tipo' => [
                'required_with:rutas',
                'in:aviso ordinario,aviso de requisicion,solicitud de anticipo'
            ],
            'rutas.carta_porte' => ['required_with:rutas', 'string', 'max:50'],
            'rutas.factura' => ['required_with:rutas', 'boolean'],
            'rutas.no_recoleccion' => ['required_with:rutas', 'integer', 'min:0'],
            'rutas.observaciones' => ['required_with:rutas', 'string', 'max:100'],

        ];
    }

    public function messages(): array
    {
        return [
            'asunto.required' => 'El asunto del oficio es obligatorio.',
            'cuerpo.required' => 'El cuerpo del oficio es obligatorio.',
            'tipo_oficio_id.required' => 'Debes seleccionar un tipo de oficio.',
            'estado_id.required' => 'Debes seleccionar un estado.',
            'folio.unique' => 'Este folio ya está registrado.',
        ];
    }
}
