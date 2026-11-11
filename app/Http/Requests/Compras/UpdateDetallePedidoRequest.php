<?php

namespace App\Http\Requests\Compras;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateDetallePedidoRequest extends FormRequest
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
            'cantidad' => ['required', 'integer'],
            'unidad_id' => ['required', 'integer', 'exists:unidads,id'],
            'descripcion' => ['required', 'varchar', 'max:155'],
            'uso' => ['required', 'varchar', 'max:155'],
            'credito' => ['required', 'boolean'],
            'fecha_pago' => ['required', 'date'],
            'codigo' => ['required', 'varchar', 'max:155'],
        ];
    }
}
