<?php

namespace App\Http\Requests\Compras;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateFolioComprasRequest extends FormRequest
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
            'folio' => ['sometimes', 'string', 'max:20'],
            'notas_autorizacion' => ['sometimes', 'string', 'max:100'],
            'observaciones' => ['sometimes', 'string', 'max:100'],
        ];
    }
}
