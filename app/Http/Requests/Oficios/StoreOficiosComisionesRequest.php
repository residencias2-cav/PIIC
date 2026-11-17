<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreOficiosComisionesRequest extends FormRequest
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
            'oficio_id' => ['required', 'integer', 'exists:oficios,id'],
            'dias' => ['required', 'integer'],
            'comision' => ['required', 'string'],
            'ciudad_destino' => ['required', 'string'],
            'fecha_hora_inicio' => ['required', 'date'],
            'fecha_hora_termino' => ['required', 'date'],
        ];
    }

    public function messages(): array
    {
        return [
            'oficio_id.required' => 'Debe seleccionar un oficio.',
            'oficio_id.exists' => 'El oficio seleccionado no existe.',
            'dias.required' => 'El número de días es obligatorio.',
            'comision.required' => 'La comisión es obligatoria.',
            'ciudad_destino.required' => 'La ciudad de destino es obligatoria.',
            'fecha_hora_inicio.required' => 'La fecha y hora de inicio son obligatorias.',
            'fecha_hora_inicio.date' => 'La fecha y hora de inicio no tienen un formato válido.',
            'fecha_hora_termino.required' => 'La fecha y hora de término son obligatorias.',
            'fecha_hora_termino.date' => 'La fecha y hora de término no tienen un formato válido.',
        ];
    }
}
