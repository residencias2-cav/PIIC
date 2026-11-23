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

            // DATOS PRINCIPALES DEL EPP
            'tipo_epp_id' => ['required', 'integer', 'exists:tipo_epps,id'],
            'obra_id' => ['required', 'integer', 'exists:obras,id'],
            'empresa_id' => ['required', 'integer', 'exists:empresas,id'],
            'motivo' => ['required', 'string', 'max:150'],
            'justificacion' => ['required', 'string', 'max:100'],
            'logistica' => ['required', 'string', 'max:100'],

            // DATOS EPP TR
            'detalles_tr' => ['nullable', 'array'],
            'detalles_tr.*.cantidad' => ['required', 'integer', 'min:1'],
            'detalles_tr.*.descripcion' => ['required', 'string', 'max:100'],
            'detalles_tr.*.codigo' => ['required', 'string', 'max:50'],
            'detalles_tr.*.marca' => ['required', 'string', 'max:50'],
            'detalles_tr.*.color' => ['required', 'string', 'max:50'],
            'detalles_tr.*.medida' => ['required', 'string', 'max:50'],
            'detalles_tr.*.clase' => ['required', 'string', 'max:50'],
            'detalles_tr.*.observaciones' => ['required', 'string', 'max:50'],
            'detalles_tr.*.estado_id' => ['required', 'integer', 'exists:estados,id'],

            // DATOS EPP NI
            'detalles_ni' => ['nullable', 'array'],
            'detalles_ni.*.trabajador_id' => ['required', 'integer', 'exists:trabajadors,id'],
            'detalles_ni.*.articulo_id' => ['required', 'integer', 'exists:articulos,id'],
            'detalles_ni.*.sup_int' => ['required', 'in:superficie,interior_mina'],

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
            'detalles_rc.*.trabajador_id' => ['required', 'integer', 'exists:trabajadors,id'],
            'detalles_rc.*.articulo_id' => ['required', 'integer', 'exists:articulos,id'],
            'detalles_rc.*.talla' => ['required', 'string', 'max:50'],

            // DATOS EPP EX
            'detalles_ex' => ['nullable', 'array'],
            'detalles_ex.*.trabajador_id' => ['required', 'integer', 'exists:trabajadors,id'],
            'detalles_ex.*.cantidad' => ['required', 'integer', 'min:1'],
            'detalles_ex.*.equipo' => ['required', 'string', 'max:50'],
            'detalles_ex.*.codigo' => ['required', 'string', 'max:50'],
            'detalles_ex.*.marca' => ['required', 'string', 'max:50'],
            'detalles_ex.*.contrato' => ['required', 'boolean'],
            'detalles_ex.*.observaciones' => ['required', 'string', 'max:100'],
            'detalles_ex.*.precio' => ['required', 'numeric', 'min:0'],
            'detalles_ex.*.adjuntos' => ['required', 'file', 'mimes:pdf', 'max:5120'],
            'detalles_ex.*.estado_id' => ['required', 'integer', 'exists:estados,id'],
            'detalles_ex.*.fecha_estado' => ['required', 'date'],
        ];
    }

    /**
     * Custom validation messages.
     */
    public function messages(): array
    {
        return [
            // DATOS PRINCIPALES
            'tipo_epp_id.required' => 'Debe seleccionar un tipo de EPP.',
            'tipo_epp_id.exists' => 'El tipo de EPP seleccionado no existe.',

            'obra_id.required' => 'Debe seleccionar una obra.',
            'obra_id.exists' => 'La obra seleccionada no existe.',

            'empresa_id.required' => 'Debe seleccionar una empresa.',
            'empresa_id.exists' => 'La empresa seleccionada no existe.',

            'motivo.required' => 'El motivo es obligatorio.',
            'justificacion.required' => 'La justificación es obligatoria.',
            'logistica.required' => 'El campo logística es obligatorio.',

            // DATOS EPP TR
            'detalles_tr.*.cantidad.required' => 'La cantidad del detalle TR es obligatoria.',
            'detalles_tr.*.descripcion.required' => 'La descripción del detalle TR es obligatoria.',
            'detalles_tr.*.codigo.required' => 'El código del detalle TR es obligatorio.',
            'detalles_tr.*.marca.required' => 'La marca del detalle TR es obligatoria.',
            'detalles_tr.*.color.required' => 'El color del detalle TR es obligatorio.',
            'detalles_tr.*.medida.required' => 'La medida del detalle TR es obligatoria.',
            'detalles_tr.*.clase.required' => 'La clase del detalle TR es obligatoria.',
            'detalles_tr.*.observaciones.required' => 'Las observaciones del detalle TR son obligatorias.',
            'detalles_tr.*.estado_id.required' => 'Debe seleccionar el estado del detalle TR.',

            // DATOS EPP NI
            'detalles_ni.*.trabajador_id.required' => 'Debe seleccionar un trabajador para el detalle NI.',
            'detalles_ni.*.articulo_id.required' => 'Debe seleccionar un artículo para el detalle NI.',
            'detalles_ni.*.sup_int.required' => 'Debe seleccionar superficie o interior mina.',

            // DATOS EPP RE
            'detalles_re.*.trabajador_id.required' => 'Debe seleccionar un trabajador para el detalle RE.',
            'detalles_re.*.fecha_ingreso.required' => 'La fecha de ingreso es obligatoria.',
            'detalles_re.*.motivo.required' => 'El motivo del detalle RE es obligatorio.',
            'detalles_re.*.articulo_id.required' => 'Debe seleccionar un artículo para el detalle RE.',
            'detalles_re.*.fecha_entrega.required' => 'La fecha de entrega es obligatoria.',
            'detalles_re.*.foto_evidencia.required' => 'Debe adjuntar una fotografía de evidencia.',
            'detalles_re.*.foto_evidencia.image' => 'El archivo de evidencia debe ser una imagen.',
            'detalles_re.*.observaciones.required' => 'Las observaciones del detalle RE son obligatorias.',
            'detalles_re.*.talla.required' => 'La talla del detalle RE es obligatoria.',
            'detalles_re.*.estado_id.required' => 'Debe seleccionar el estado del detalle RE.',
            'detalles_re.*.fecha_estado.required' => 'La fecha del estado es obligatoria.',

            // DATOS EPP RC
            'detalles_rc.*.trabajador_id.required' => 'Debe seleccionar un trabajador para el detalle RC.',
            'detalles_rc.*.articulo_id.required' => 'Debe seleccionar un artículo para el detalle RC.',
            'detalles_rc.*.talla.required' => 'La talla del detalle RC es obligatoria.',

            // DATOS EPP EX
            'detalles_ex.*.trabajador_id.required' => 'Debe seleccionar un trabajador para el detalle EX.',
            'detalles_ex.*.cantidad.required' => 'La cantidad del detalle EX es obligatoria.',
            'detalles_ex.*.equipo.required' => 'El nombre del equipo es obligatorio.',
            'detalles_ex.*.codigo.required' => 'El código del equipo es obligatorio.',
            'detalles_ex.*.marca.required' => 'La marca del equipo es obligatoria.',
            'detalles_ex.*.contrato.required' => 'Debe indicar si existe contrato.',
            'detalles_ex.*.observaciones.required' => 'Las observaciones del detalle EX son obligatorias.',
            'detalles_ex.*.precio.required' => 'El precio del equipo es obligatorio.',
            'detalles_ex.*.adjuntos.required' => 'Debe adjuntar el documento PDF.',
            'detalles_ex.*.adjuntos.mimes' => 'El documento adjunto debe estar en formato PDF.',
            'detalles_ex.*.estado_id.required' => 'Debe seleccionar el estado del detalle EX.',
            'detalles_ex.*.fecha_estado.required' => 'La fecha del estado es obligatoria.',
        ];
    }

    /**
     * Prepare data before validation.
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'folio' => $this->folio
                ? strtoupper(trim($this->folio))
                : null,
        ]);
    }
}