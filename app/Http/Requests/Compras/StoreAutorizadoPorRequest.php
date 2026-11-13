<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreAutorizadoPorRequest extends FormRequest
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
            'trabajador_id' => ['required', 'integer', 'exists:trabajadors,id'],
            'epp_id' => ['required', 'integer', 'exists:epps,id'],
            'proceso_autorizado' => ['required', 'boolean'],
            'fecha_autorizacion' => ['required', 'date'],
            'observaciones' => ['required', 'string', 'max:100'],
        ];
    }

    public function messages(): array
    {
        return [
            'trabajador_id.required' => 'Debe seleccionar un trabajador.',
            'trabajador_id.exists' => 'El trabajador seleccionado no existe.',
            'epp_id.required' => 'Debe seleccionar un EPP.',
            'epp_id.exists' => 'El EPP seleccionado no existe.',
            'proceso_autorizado.required' => 'Debe indicar si el proceso fue autorizado.',
            'fecha_autorizacion.required' => 'La fecha de autorización es obligatoria.',
            'fecha_autorizacion.date' => 'La fecha de autorización no tiene un formato válido.',
            'observaciones.required' => 'Las observaciones son obligatorias.',
        ];
    }
}
