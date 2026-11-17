<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateOficiosComisionesRequest extends FormRequest
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
            'dias' => ['sometimes', 'integer'],
            'comision' => ['sometimes', 'string'],
            'ciudad_destino' => ['sometimes', 'string'],
            'fecha_hora_inicio' => ['sometimes', 'date'],
            'fecha_hora_termino' => ['sometimes', 'date'],
        ];
    }
}
