<?php

namespace App\Http\Requests\Compras;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateDatosCotizacionRequest extends FormRequest
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
            'cotizacion_id' => ['sometimes', 'integer', 'exists:cotizacions,id'],
            'unidad_id' => ['sometimes', 'integer', 'exists:unidads,id'],
            'descripcion' => ['sometimes', 'string', 'max:150'],
            'codigo' => ['sometimes', 'string', 'max:150'],
            'entregado' => ['sometimes', 'boolean'],
            'fecha_r' => ['sometimes', 'string', 'max:150'],
        ];
    }
}
