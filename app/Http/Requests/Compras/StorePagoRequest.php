<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StorePagoRequest extends FormRequest
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
            'proveedor_id' => ['required', 'integer', 'exists:proveedors,id'],
            'precio' => ['required', 'numeric', 'decimal:2'],
            'iva' => ['required', 'numeric', 'decimal:2'],
            'total' => ['required', 'numeric', 'decimal:2'],
            'descuento' => ['numeric', 'decimal:2'],
            'factura' => ['required', 'numeric', 'decimal:2'],
            'comision' => ['required', 'numeric', 'decimal:2'],
        ];
    }

    public function messages():array
    {
        return [
            'proveedor_id.required' => 'Se debe especificar un proveedor',  
            
            'precio.required' => 'Se debe especificar el precio',  
            
            'iva.required' => 'Se debe especificar el iva',  
            
            'total.required' => 'Se debe especificar el total'
            ];
    }
}
