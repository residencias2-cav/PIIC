<?php

namespace App\Http\Requests\Compras;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreDatosCotizacionRequest extends FormRequest
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
            'cotizacion_id' => ['required', 'integer', 'exists:cotizacions,id'],
            'unidad_id' => ['required', 'integer', 'exists:unidads,id'],
            'descripcion' => ['required', 'string', 'max:150'],
            'codigo' => ['required', 'string', 'max:150'],
            'entregado' => ['required', 'boolean'],
            'fecha_r' => ['required', 'string', 'max:150'],
        ];
    }

    public function messages(): array
    {
        return [
            'cotizacion_id.required' => 'Debe seleccionar una cotización.',
            'cotizacion_id.exists' => 'La cotización seleccionada no existe.',
            'unidad_id.required' => 'Debe seleccionar una unidad.',
            'unidad_id.exists' => 'La unidad seleccionada no existe.',
            'descripcion.required' => 'La descripción es obligatoria.',
            'codigo.required' => 'El código es obligatorio.',
            'entregado.required' => 'Debe indicar si fue entregado.',
            'fecha_r.required' => 'La fecha de referencia es obligatoria.',
        ];
    }
}
