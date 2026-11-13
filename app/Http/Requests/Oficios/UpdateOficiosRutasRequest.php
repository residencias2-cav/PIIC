<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateOficiosRutasRequest extends FormRequest
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
            'oficio_id' => ['sometimes', 'integer', 'exists:oficios,id'],
            'folio_ac' => ['sometimes', 'string', 'max:20'],
            'ruta' => ['sometimes', 'string', 'max:100'],
            'trabajador_id' => ['sometimes', 'integer', 'exists:trabajadors,id'],
            'tipo' => ['sometimes', 'string', 'in:aviso ordinario,aviso de requisicion,solicitud de anticipo'],
            'carta_porte' => ['sometimes', 'string', 'max:50'],
            'factura' => ['sometimes', 'boolean'],
            'no_recoleccion' => ['sometimes', 'integer'],
            'observaciones' => ['sometimes', 'string', 'max:100'],
        ];
    }
}
