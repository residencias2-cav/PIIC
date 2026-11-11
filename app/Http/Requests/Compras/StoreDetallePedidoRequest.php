<?php

namespace App\Http\Requests\Compras;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreDetallePedidoRequest extends FormRequest
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
            'pedido_id' => ['required', 'integer', 'exists:pedidos,id'],
            'partida' => ['required', 'integer'],
            'cantidad' => ['required', 'integer'],
            'unidad_id' => ['required', 'integer', 'exists:unidads,id'],
            'descripcion' => ['required', 'varchar', 'max:155'],
            'uso' => ['required', 'varchar', 'max:155'],
            'credito' => ['required', 'boolean'],
            'fecha_pago' => ['required', 'date'],
            'codigo' => ['required', 'varchar', 'max:155'],
        ];
    }

    public function messages()
    {
        return [
            'cantidad.required' => 'Debe especificarse una cantidad',

            'unidad.required' => 'Debe especificarse la unidad de medida del producto',

            'descripcion.required' => 'Debe especificarse la descripcion del producto',

            'uso.required' => 'Debe especificarse el uso del producto',

            'credito.required' => 'Debe especificarse el tipo de pago',

            'fecha_pago.required' => 'Debe especificarse la fecha de pago',

            'codigo.required' => 'Debe especificarse el codigo del producto'
        ];
    }
}
