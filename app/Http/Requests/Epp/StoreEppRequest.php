<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreEppRequest extends FormRequest
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
            'fecha' => ['required', 'date'],
            'folio' => ['required', 'string', 'max:20', 'unique:epps,folio'],
            'tipo_epp_id' => ['required', 'integer', 'exists:tipo_epps, id'],
            'obra_id' => ['required', 'integer', 'exists:obras,id'],
            'empresa_id' => ['required', 'integer', 'exists:empresas,id'],
            'motivo' => ['required', 'string', 'max:150'],
            'justificacion' => ['required', 'string', 'max:100'],
            'logistica' => ['required', 'string', 'max:100'],
            'created_by' => ['required', 'integer'],
        ];
    }

    public function messages(): array
    {
        return [
            'fecha.required' => 'La fecha es obligatoria.',
            'fecha.date' => 'La fecha no tiene formato valido.',

            'folio.required' => 'El folio es obligatorio.',
            'folio.unique' => 'Ya existe este folio',

            'tipo_epp_id.required' => 'Debe seleccionar un tipo de EPP.',
            'tipo__epp_id.exists' => 'El tipo de EPP seleccionado no existe.',
            
            'obra_id.required' => 'Debe seleccionar una obra.',
            'obra_id.exists' => 'La obra seleccionada no existe',

            'empresa_id.required' => 'Debe seleccionar una empresa.',
            'empresa_id.exists' => 'La empresa seleccionada no existe.',
            ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'folio' => $this->folio ? strtoupper(trim($this->folio)): null,
        ]);
    }
}
