<?php

namespace App\Http\Requests\Oficios;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateOficiosRequest extends FormRequest
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
            'folio' => ['required', 'string', 'max:20', 'unique:oficios,folio,'],
            'fecha' => ['required', 'date'],
            'asunto' => ['required', 'string', 'max:200'],
            'cuerpo' => ['required', 'string', 'max:200'],
            'tipo_oficio_id' => ['required', 'integer', 'exists:tipo_oficios, id'],
            'estado_id' => ['required', 'integer', 'exists:estados, id'],
            'observaciones' => ['required', 'string', 'max:200'],
            'cargos_generales' => ['required', 'string', 'max:150'],
        ];
    }
}
