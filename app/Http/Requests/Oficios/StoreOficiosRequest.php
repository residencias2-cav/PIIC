<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreOficiosRequest extends FormRequest
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
            'folio' => ['required', 'string', 'max:20', 'unique:oficios,folio'],
            'fecha' => ['required', 'date'],
            'asunto' => ['required', 'string', 'max:200'],
            'cuerpo' => ['required', 'string', 'max:200'],
            'tipo_oficio_id' => ['required', 'integer', 'exists:tipo_oficios, id'],
            'estado_id' => ['required', 'integer', 'exists:estados, id'],
            'observaciones' => ['required', 'string', 'max:200'],
            'cargos_generales' => ['required', 'string', 'max:150'],
        ];
    }

    public function messages()
    {
        return [
            'folio.required' => 'El campo folio es requerido',
            
            'fecha.required' => 'El campo fecha es requerido',
            'fecha.date' => 'La fecha no tiene formato valido',
            
            'asunto.required' => 'El campo asunto es requerido',

            'cuerpo.required' => 'El campo cuerpo es requerido',

            'tipo_oficio_id.required' => 'El campo tipo de oficio es requerido',
            
            'estado_id.required' => 'El campo estado es requerido',

            'observaciones.required' => 'El campo observaciones es requerido',

            'cargos_generales.required' => 'El campo cargos generales es requerido',
            ];
    }

    public function prepareForValidation()
    {
        $this->merge([
            'folio' => $this->folio ? strtoupper(trim($this->folio)): null,
        ]);
    }
}
