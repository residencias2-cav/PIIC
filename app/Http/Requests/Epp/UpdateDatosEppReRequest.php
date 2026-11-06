<?php

namespace App\Http\Requests\Epp;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateDatosEppReRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return  true;
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
            'fecha_ingreso' => ['sometimes', 'date'],
            'motivo' => ['sometimes', 'string', 'max:100'],
            'fecha_entrega' => ['sometimes', 'date'],
            'foto_evidencia' => ['sometimes', 'string', 'max:50'],
            'observaciones' => ['sometimes', 'string', 'max:100'],
            'talla' => ['required', 'integer'],
        ];
    }
}
