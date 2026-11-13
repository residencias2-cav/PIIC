<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateAutorizadoPorRequest extends FormRequest
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
            'trabajador_id' => ['sometimes', 'integer', 'exists:trabajadors,id'],
            'epp_id' => ['sometimes', 'integer', 'exists:epps,id'],
            'proceso_autorizado' => ['sometimes', 'boolean'],
            'fecha_autorizacion' => ['sometimes', 'date'],
            'observaciones' => ['sometimes', 'string', 'max:100'],
        ];
    }
}
