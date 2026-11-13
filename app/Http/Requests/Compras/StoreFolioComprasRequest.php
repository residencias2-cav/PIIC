<?php

namespace App\Http\Requests\Compras;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreFolioComprasRequest extends FormRequest
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
            'folio' => ['required', 'string', 'max:20'],
            'notas_autorizacion' => ['required', 'string', 'max:100'],
            'observaciones' => ['required', 'string', 'max:100'],
        ];
    }

    public function messages(): array
    {
        return [
            'pedido_id.required' => 'Debe seleccionar un pedido.',
            'pedido_id.exists' => 'El pedido seleccionado no existe.',
            'fecha.required' => 'La fecha es obligatoria.',
            'fecha.date' => 'La fecha no tiene un formato válido.',
            'folio.required' => 'El folio es obligatorio.',
            'notas_autorizacion.required' => 'Las notas de autorización son obligatorias.',
            'observaciones.required' => 'Las observaciones son obligatorias.',
        ];
    }
}
