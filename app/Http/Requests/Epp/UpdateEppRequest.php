<?php

namespace App\Http\Requests\Epp;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateEppRequest extends FormRequest
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
            'fecha'=> ['sometimes', 'date'],
            'folio'=> ['sometimes', 'string', 'max:20', 'unique:epps,folio'],
            'tipo_epp_id'=> ['sometimes', 'integer', 'exists:tipo_epps,id'],
            'obra_id'=> ['sometimes', 'integer', 'exists:obras,id'],
            'empresa_id'=> ['sometimes', 'integer', 'exists:empresas,id'],
            'motivo'=> ['sometimes', 'string', 'max:150'],
            'justificacion'=> ['sometimes', 'string', 'max:100'],
            'logistica'=> ['sometimes', 'string', 'max:100'],
        ];
    }
}
