<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePagoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
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
            'precio' => ['required', 'numeric', 'decimal:2'],
            'iva' => ['required', 'numeric', 'decimal:2'],
            'total' => ['required', 'numeric', 'decimal:2'],
            'descuento' => ['numeric', 'decimal:2'],
            'factura' => ['required', 'numeric', 'decimal:2'],
            'comision' => ['required', 'numeric', 'decimal:2'],
        ];
    }
}
