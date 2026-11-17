<?php

namespace App\Http\Requests\Oficios;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateMantenimientosRequest extends FormRequest
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
            'pedido_id' => ['sometimes', 'integer', 'exists:pedidos,id'],
            'fecha' => ['sometimes', 'date'],
            'trabajador_id' => ['sometimes', 'integer', 'exists:trabajadors,id'],
            'gerencia_id' => ['sometimes', 'integer', 'exists:gerencias,id'],
            'folio' => ['sometimes', 'string', 'max:20'],
            'lugar' => ['sometimes', 'string', 'max:150'],
            'descripcion' => ['sometimes', 'string', 'max:150'],
            'material_necesario' => ['sometimes', 'string'],
            'autorizado_por_id' => ['sometimes', 'integer', 'exists:autorizado_pors,id'],
            'surtido' => ['sometimes', 'boolean'],
        ];
    }
}
