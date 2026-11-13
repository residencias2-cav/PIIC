<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use App\Enums\sup_int;
use Illuminate\Validation\Rule;

class UpdateUsuariosProveedoresRequest extends FormRequest
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
            'trabajador_id' => ['sometimes', 'integer', 'exists:trabajadores,id'],
            'articulo_id' => ['sometimes', 'integer', 'exists:articulos,id'],
            'sup_int' => ['sometimes', Rule::enum(sup_int::class)],
        ];
    }
}
