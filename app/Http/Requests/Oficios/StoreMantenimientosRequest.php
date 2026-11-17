<?php

namespace App\Http\Requests\Oficios;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreMantenimientosRequest extends FormRequest
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
            'trabajador_id' => ['required', 'integer', 'exists:trabajadors,id'],
            'gerencia_id' => ['required', 'integer', 'exists:gerencias,id'],
            'folio' => ['required', 'string', 'max:20'],
            'lugar' => ['required', 'string', 'max:150'],
            'descripcion' => ['required', 'string', 'max:150'],
            'material_necesario' => ['required', 'string'],
            'autorizado_por_id' => ['required', 'integer', 'exists:autorizado_pors,id'],
            'surtido' => ['required', 'boolean'],
        ];
    }

    public function messages(): array
    {
        return [
            'pedido_id.required' => 'Debe seleccionar un pedido.',
            'pedido_id.exists' => 'El pedido seleccionado no existe.',
            'fecha.required' => 'La fecha es obligatoria.',
            'fecha.date' => 'La fecha no tiene un formato válido.',
            'trabajador_id.required' => 'Debe seleccionar un trabajador.',
            'trabajador_id.exists' => 'El trabajador seleccionado no existe.',
            'gerencia_id.required' => 'Debe seleccionar una gerencia.',
            'gerencia_id.exists' => 'La gerencia seleccionada no existe.',
            'folio.required' => 'El folio es obligatorio.',
            'lugar.required' => 'El lugar es obligatorio.',
            'descripcion.required' => 'La descripción es obligatoria.',
            'material_necesario.required' => 'El material necesario es obligatorio.',
            'autorizado_por_id.required' => 'Debe seleccionar quién autoriza.',
            'autorizado_por_id.exists' => 'La autorización seleccionada no existe.',
            'surtido.required' => 'Debe indicar si fue surtido.',
        ];
    }
}
