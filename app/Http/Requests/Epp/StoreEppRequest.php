<?php

namespace App\Http\Requests\Epp;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreEppRequest extends FormRequest
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
            'fecha' => ['required', 'date'],
            'folio' => ['required', 'string', 'max:20', 'unique:epps,folio'],
            'tipo_epp_id' => ['required', 'integer', 'exists:tipo_epps,id'],
            'obra_id' => ['required', 'integer', 'exists:obras,id'],
            'empresa_id' => ['required', 'integer', 'exists:empresas,id'],
            'motivo' => ['required', 'string', 'max:150'],
            'justificacion' => ['required', 'string', 'max:100'],
            'logistica' => ['required', 'string', 'max:100'],
            'created_by' => ['required', 'integer'],

            #DATOS EPPTR
            'detalles_tr' => ['nullable', 'array',],
            'detalles_tr.*.cantidad' => ['required','integer','min:1',],
            'detalles_tr.*.descripcion' => ['required','string','max:100',],
            'detalles_tr.*.codigo' => ['required','string','max:50',],
            'detalles_tr.*.marca' => ['required','string','max:50',],
            'detalles_tr.*.color' => ['required','string','max:50',],
            'detalles_tr.*.medida' => ['required','string','max:50',],
            'detalles_tr.*.clase' => ['required','string','max:50',],
            'detalles_tr.*.observaciones' => ['required','string','max:50',],
            'detalles_tr.*.estado_id' => ['required','integer','exists:estados,id',],

            #DATOS EPPNI
            'detalles_ni' => ['nullable', 'array'],
            'detalles_ni.*.trabajador_id' => ['required','integer','exists:trabajadors,id',],
            'detalles_ni.*.articulo_id' => ['required','integer','exists:articulos,id',],
            'detalles_ni.*.sup_int' => ['required','in:superficie,interior_mina',],

            // DATOS EPP RE
            'detalles_re' => ['nullable', 'array'],
            'detalles_re.*.trabajador_id' => ['required', 'integer', 'exists:trabajadors,id'],
            'detalles_re.*.fecha_ingreso' => ['required', 'date'],
            'detalles_re.*.motivo' => ['required', 'string', 'max:100'],
            'detalles_re.*.articulo_id' => ['required', 'integer', 'exists:articulos,id'],
            'detalles_re.*.fecha_entrega' => ['required', 'date'],
            'detalles_re.*.foto_evidencia' => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'detalles_re.*.observaciones' => ['required', 'string', 'max:100'],
            'detalles_re.*.talla' => ['required', 'integer', 'min:1'],
            'detalles_re.*.estado_id' => ['required', 'integer', 'exists:estados,id'],
            'detalles_re.*.fecha_estado' => ['required', 'date'],

            // DATOS EPP RC
            'detalles_rc' => ['nullable', 'array'],
            'detalles_rc.*.trabajador_id' => ['required','integer','exists:trabajadors,id'],
            'detalles_rc.*.articulo_id' => ['required','integer','exists:articulos,id'],
            'detalles_rc.*.talla' => ['required','string','max:50'],

            //DATOS EPP EX
            'detalles_ex' => ['nullable', 'array'],
            'detalles_ex.*.trabajador_id' => ['required','integer','exists:trabajadors,id'],
            'detalles_ex.*.cantidad' => ['required','integer','min:1'],
            'detalles_ex.*.equipo' => ['required','string','max:50'],
            'detalles_ex.*.codigo' => ['required','string','max:50'],
            'detalles_ex.*.marca' => ['required','string','max:50'],
            'detalles_ex.*.contrato' => ['required','boolean'],
            'detalles_ex.*.observaciones' => ['required','string','max:100'],
            'detalles_ex.*.precio' => ['required','numeric','min:0'],
            'detalles_ex.*.adjuntos' => ['required','file','mimes:pdf','max:5120'],
            'detalles_ex.*.estado_id' => ['required','integer','exists:estados,id'],
            'detalles_ex.*.fecha_estado' => ['required','date'],
        ];
    }

    public function messages(): array
    {
        return [
            'fecha.required' => 'La fecha es obligatoria.',
            'fecha.date' => 'La fecha no tiene formato valido.',

            'folio.required' => 'El folio es obligatorio.',
            'folio.unique' => 'Ya existe este folio',

            'tipo_epp_id.required' => 'Debe seleccionar un tipo de EPP.',
            'tipo__epp_id.exists' => 'El tipo de EPP seleccionado no existe.',
            
            'obra_id.required' => 'Debe seleccionar una obra.',
            'obra_id.exists' => 'La obra seleccionada no existe',

            'empresa_id.required' => 'Debe seleccionar una empresa.',
            'empresa_id.exists' => 'La empresa seleccionada no existe.',
            ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'folio' => $this->folio ? strtoupper(trim($this->folio)): null,
        ]);
    }
}
