<?php

namespace App\Http\Requests\Epp;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateInventarioEppRequest extends FormRequest
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
            'articulo_id' => ['sometimes', 'integer', 'exists:articulos,id'],
            'talla' => ['sometimes', 'integer'],
            'existencia' => ['sometimes', 'integer'],
        ];
    }
}
