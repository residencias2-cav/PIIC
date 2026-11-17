<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreOficiosRutasRequest extends FormRequest
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
            'folio_ac' => ['required', 'string', 'max:20'],
            'ruta' => ['required', 'string', 'max:100'],
            'trabajador_id' => ['required', 'integer', 'exists:trabajadors,id'],
            'tipo' => ['required', 'string', 'in:aviso ordinario,aviso de requisicion,solicitud de anticipo'],
            'carta_porte' => ['required', 'string', 'max:50'],
            'factura' => ['required', 'boolean'],
            'no_recoleccion' => ['required', 'integer'],
            'observaciones' => ['required', 'string', 'max:100'],
        ];
    }

    public function messages(): array
    {
        return [
            'oficio_id.required' => 'Debe seleccionar un oficio.',
            'oficio_id.exists' => 'El oficio seleccionado no existe.',
            'folio_ac.required' => 'El folio AC es obligatorio.',
            'ruta.required' => 'La ruta es obligatoria.',
            'trabajador_id.required' => 'Debe seleccionar un trabajador.',
            'trabajador_id.exists' => 'El trabajador seleccionado no existe.',
            'tipo.required' => 'Debe seleccionar un tipo de aviso.',
            'tipo.in' => 'El tipo de aviso seleccionado no es válido.',
            'carta_porte.required' => 'La carta porte es obligatoria.',
            'factura.required' => 'Debe indicar si cuenta con factura.',
            'no_recoleccion.required' => 'El número de recolección es obligatorio.',
            'observaciones.required' => 'Las observaciones son obligatorias.',
        ];
    }
}
