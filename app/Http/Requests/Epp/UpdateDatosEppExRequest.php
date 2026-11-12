<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateDatosEppExRequest extends FormRequest
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
            'trabajador_id' => ['sometimes', 'integer', 'exists:trabajadors,id'],
            'cantidad' => ['sometimes', 'integer'],
            'equipo' => ['sometimes', 'string', 'max:50'],
            'codigo' => ['sometimes', 'string', 'max:50'],
            'marca' => ['sometimes', 'string', 'max:50'],
            'contrato' => ['sometimes', 'boolean'],
            'observaciones' => ['sometimes','string', 'max:100'],
            'precio' => ['sometimes', 'numeric', 'decimal:2'],
            'adjuntos' => ['sometimes', 'string', 'max:50'],
        ];
    }
}
