<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreCategoriaRequest extends FormRequest
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
            'oficios_id' => ['required', 'integer', 'exists:oficios,id'],
            'pedido_id' => ['required', 'integer', 'exists:pedidos,id'],
            'trabajador_id' => ['required', 'integer', 'exists:trabajadors,id'],
            'firma' => ['required', 'string', 'max:30'],
        ];
    }

    public function messages(): array
    {
        return [
            'oficios_id.required' => 'Debe seleccionar un oficio.',
            'oficios_id.exists' => 'El oficio seleccionado no existe.',
            'pedido_id.required' => 'Debe seleccionar un pedido.',
            'pedido_id.exists' => 'El pedido seleccionado no existe.',
            'trabajador_id.required' => 'Debe seleccionar un trabajador.',
            'trabajador_id.exists' => 'El trabajador seleccionado no existe.',
            'firma.required' => 'La firma es obligatoria.',
        ];
    }
}
