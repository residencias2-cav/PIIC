<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Nueva solicitud EPP</title>

    <link
        rel="stylesheet"
        href="{{ asset('css/catalogos.css') }}"
    >
</head>

<body>

    <main class="formulario-card">

        {{-- =====================================================
             ENCABEZADO
             ===================================================== --}}

        <header class="formulario-header">

            <div class="catalogo-linea"></div>

            <div>

                <h1 class="formulario-titulo">
                    Registrar solicitud EPP
                </h1>

                <p class="formulario-descripcion">
                    Ingresa la información general y agrega los elementos
                    correspondientes al tipo de EPP seleccionado.
                </p>

            </div>

        </header>


        {{-- =====================================================
             FORMULARIO PRINCIPAL
             ===================================================== --}}

        <form
            id="formulario-epp"
            action="{{ route('epp.store') }}"
            method="POST"
        >

            @csrf


            {{-- =================================================
                 IDENTIFICACIÓN
                 ================================================= --}}

            <section class="formulario-seccion">

                <h2 class="formulario-seccion-titulo">
                    Identificación
                </h2>

                <div class="formulario-grid">

                    {{-- Fecha --}}
                    <div class="campo campo-bloqueado">

                        <label for="fecha_visual">
                            Fecha
                        </label>

                        <input
                            type="date"
                            id="fecha_visual"
                            value="{{ now()->toDateString() }}"
                            readonly
                        >

                        <p class="campo-ayuda">
                            Se asigna automáticamente.
                        </p>

                    </div>


                    {{-- Folio --}}
                    <div class="campo campo-bloqueado">

                        <label for="folio_visual">
                            Folio
                        </label>

                        <input
                            type="text"
                            id="folio_visual"
                            value="{{ $siguienteFolio }}"
                            readonly
                        >

                        <p class="campo-ayuda">
                            Se genera automáticamente.
                        </p>

                    </div>

                </div>

            </section>


            {{-- =================================================
                 INFORMACIÓN GENERAL
                 ================================================= --}}

            <section class="formulario-seccion">

                <h2 class="formulario-seccion-titulo">
                    Información general
                </h2>


                {{-- Tipo EPP --}}
                <div class="campo">

                    <label for="tipo_epp_id">
                        Tipo de EPP
                    </label>

                    <select
                        id="tipo_epp_id"
                        name="tipo_epp_id"
                        required
                    >

                        <option value="">
                            Selecciona un tipo
                        </option>

                        @foreach ($tiposEpp as $tipoEpp)

                            <option
                                value="{{ $tipoEpp->id }}"
                                @selected(
                                    old('tipo_epp_id') == $tipoEpp->id
                                )
                            >
                                {{ $tipoEpp->nombre }}
                            </option>

                        @endforeach

                    </select>

                    @error('tipo_epp_id')
                        <p class="mensaje-error">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                <div class="formulario-grid">

                    {{-- Obra --}}
                    <div class="campo">

                        <label for="obra_id">
                            Obra
                        </label>

                        <select
                            id="obra_id"
                            name="obra_id"
                            required
                        >

                            <option value="">
                                Selecciona una obra
                            </option>

                            @foreach ($obras as $obra)

                                <option
                                    value="{{ $obra->id }}"
                                    @selected(
                                        old('obra_id') == $obra->id
                                    )
                                >
                                    {{ $obra->nombre_obra }}
                                </option>

                            @endforeach

                        </select>

                        @error('obra_id')
                            <p class="mensaje-error">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    {{-- Empresa --}}
                    <div class="campo">

                        <label for="empresa_id">
                            Empresa
                        </label>

                        <select
                            id="empresa_id"
                            name="empresa_id"
                            required
                        >

                            <option value="">
                                Selecciona una empresa
                            </option>

                            @foreach ($empresas as $empresa)

                                <option
                                    value="{{ $empresa->id }}"
                                    @selected(
                                        old('empresa_id') == $empresa->id
                                    )
                                >
                                    {{ $empresa->nombre }}
                                </option>

                            @endforeach

                        </select>

                        @error('empresa_id')
                            <p class="mensaje-error">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>

                </div>

            </section>


            {{-- =================================================
                 DETALLE GENERAL
                 ================================================= --}}

            <section class="formulario-seccion">

                <h2 class="formulario-seccion-titulo">
                    Detalle de la solicitud
                </h2>


                {{-- Motivo --}}
                <div class="campo">

                    <label for="motivo">
                        Motivo
                    </label>

                    <input
                        type="text"
                        id="motivo"
                        name="motivo"
                        value="{{ old('motivo') }}"
                        maxlength="150"
                        placeholder="Motivo de la solicitud"
                        required
                    >

                    @error('motivo')
                        <p class="mensaje-error">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                {{-- Justificación --}}
                <div class="campo">

                    <label for="justificacion">
                        Justificación
                    </label>

                    <textarea
                        id="justificacion"
                        name="justificacion"
                        rows="4"
                        maxlength="100"
                        placeholder="Describe la justificación de la solicitud"
                        required
                    >{{ old('justificacion') }}</textarea>

                    @error('justificacion')
                        <p class="mensaje-error">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                {{-- Logística --}}
                <div class="campo">

                    <label for="logistica">
                        Logística
                    </label>

                    <textarea
                        id="logistica"
                        name="logistica"
                        rows="3"
                        maxlength="100"
                        placeholder="Información de logística"
                        required
                    >{{ old('logistica') }}</textarea>

                    @error('logistica')
                        <p class="mensaje-error">
                            {{ $message }}
                        </p>
                    @enderror

                </div>

            </section>


            {{-- =================================================
                 FORMULARIOS NIVEL 3
                 =================================================
                 includeIf permite que todavía no existan todos los
                 parciales sin provocar un error.
                 ================================================= --}}

            @includeIf('Epp.DatosEppEx._form')

            @includeIf('Epp.DatosEppTr._form')

            @includeIf('Epp.DatosEppRe._form')

            @includeIf('Epp.DatosEppNi._form')

            @includeIf('Epp.DatosEppRc._form')


            {{-- =================================================
                 ACCIONES
                 ================================================= --}}

            <div class="formulario-acciones">

                <a
                    href="{{ route('epp.index') }}"
                    class="btn btn-secundario"
                >
                    Cancelar
                </a>

                <button
                    type="submit"
                    class="btn btn-principal"
                >
                    Guardar solicitud
                </button>

            </div>

        </form>

    </main>


    {{-- =========================================================
         JAVASCRIPT
         ========================================================= --}}

    <script>
        document.addEventListener('DOMContentLoaded', function () {

            const formulario =
                document.getElementById('formulario-epp');

            const tipoEpp =
                document.getElementById('tipo_epp_id');


            /*
            |--------------------------------------------------------------------------
            | Secciones de cada tipo
            |--------------------------------------------------------------------------
            |
            | Cada parcial debe utilizar el ID indicado:
            |
            | EppEx: seccion-epp-ex
            | EppTr: seccion-epp-tr
            | EppRe: seccion-epp-re
            | EppNi: seccion-epp-ni
            | EppRc: seccion-epp-rc
            |
            */

            const seccionesEpp = {
                eppex:
                    document.getElementById('seccion-epp-ex'),

                epptr:
                    document.getElementById('seccion-epp-tr'),

                eppre:
                    document.getElementById('seccion-epp-re'),

                eppni:
                    document.getElementById('seccion-epp-ni'),

                epprc:
                    document.getElementById('seccion-epp-rc'),
            };


            /*
            |--------------------------------------------------------------------------
            | Obtener tipo seleccionado
            |--------------------------------------------------------------------------
            */

            function obtenerTipoSeleccionado() {

                if (!tipoEpp) {
                    return '';
                }

                const opcion =
                    tipoEpp.options[tipoEpp.selectedIndex];

                if (!opcion || !opcion.value) {
                    return '';
                }

                return opcion.text
                    .trim()
                    .toLowerCase()
                    .replace(/\s+/g, '');
            }


            /*
            |--------------------------------------------------------------------------
            | Mostrar solo la sección correspondiente
            |--------------------------------------------------------------------------
            */

            function actualizarFormularioEpp() {

                Object.values(seccionesEpp)
                    .forEach(function (seccion) {

                        if (seccion) {
                            seccion.style.display = 'none';
                        }

                    });


                const tipo =
                    obtenerTipoSeleccionado();


                if (
                    tipo &&
                    seccionesEpp[tipo]
                ) {
                    seccionesEpp[tipo].style.display =
                        'block';
                }
            }


            tipoEpp?.addEventListener(
                'change',
                actualizarFormularioEpp
            );

            actualizarFormularioEpp();


            /*
            |--------------------------------------------------------------------------
            | Funciones auxiliares
            |--------------------------------------------------------------------------
            */

            function escaparHtml(valor) {

                const elemento =
                    document.createElement('div');

                elemento.textContent =
                    String(valor);

                return elemento.innerHTML;
            }


            function escaparAtributo(valor) {

                return String(valor)
                    .replaceAll('&', '&amp;')
                    .replaceAll('"', '&quot;')
                    .replaceAll('<', '&lt;')
                    .replaceAll('>', '&gt;');
            }


            /*
            |--------------------------------------------------------------------------
            | DATOS EPP TR
            |--------------------------------------------------------------------------
            */

            const seccionTr =
                seccionesEpp.epptr;

            const botonAgregarTr =
                document.getElementById('agregar-tr');

            const listaElementosTr =
                document.getElementById('lista-elementos-tr');

            const inputsOcultosTr =
                document.getElementById('inputs-ocultos-tr');

            let indiceTr = 0;


            /*
            |--------------------------------------------------------------------------
            | Limpiar campos EppTr
            |--------------------------------------------------------------------------
            */

            function limpiarFormularioTr() {

                const campos = [
                    'tr_cantidad',
                    'tr_descripcion',
                    'tr_codigo',
                    'tr_marca',
                    'tr_color',
                    'tr_medida',
                    'tr_clase',
                    'tr_observaciones',
                    'tr_estado_id',
                ];

                campos.forEach(function (id) {

                    const campo =
                        document.getElementById(id);

                    if (campo) {
                        campo.value = '';
                    }

                });

                document
                    .getElementById('tr_cantidad')
                    ?.focus();
            }


            /*
            |--------------------------------------------------------------------------
            | Mostrar mensaje cuando no hay elementos
            |--------------------------------------------------------------------------
            */

            function actualizarTablaVaciaTr() {

                if (!listaElementosTr) {
                    return;
                }

                const filas =
                    listaElementosTr.querySelectorAll(
                        'tr[data-indice-tr]'
                    );

                const filaVacia =
                    document.getElementById('tr-vacio');


                if (
                    filas.length === 0 &&
                    !filaVacia
                ) {

                    listaElementosTr.insertAdjacentHTML(
                        'beforeend',
                        `
                            <tr id="tr-vacio">

                                <td
                                    colspan="9"
                                    class="estado-vacio"
                                >
                                    No hay elementos agregados.
                                </td>

                            </tr>
                        `
                    );
                }


                if (
                    filas.length > 0 &&
                    filaVacia
                ) {
                    filaVacia.remove();
                }
            }


            /*
            |--------------------------------------------------------------------------
            | Agregar elemento EppTr
            |--------------------------------------------------------------------------
            */

            botonAgregarTr?.addEventListener(
                'click',
                function () {

                    const cantidad =
                        document
                            .getElementById('tr_cantidad')
                            ?.value
                            .trim() ?? '';

                    const descripcion =
                        document
                            .getElementById('tr_descripcion')
                            ?.value
                            .trim() ?? '';

                    const codigo =
                        document
                            .getElementById('tr_codigo')
                            ?.value
                            .trim() ?? '';

                    const marca =
                        document
                            .getElementById('tr_marca')
                            ?.value
                            .trim() ?? '';

                    const color =
                        document
                            .getElementById('tr_color')
                            ?.value
                            .trim() ?? '';

                    const medida =
                        document
                            .getElementById('tr_medida')
                            ?.value
                            .trim() ?? '';

                    const clase =
                        document
                            .getElementById('tr_clase')
                            ?.value
                            .trim() ?? '';

                    const observaciones =
                        document
                            .getElementById('tr_observaciones')
                            ?.value
                            .trim() ?? '';

                    const estadoSelect =
                        document.getElementById(
                            'tr_estado_id'
                        );

                    const estadoId =
                        estadoSelect?.value ?? '';

                    const estadoNombre =
                        estadoSelect
                            ?.options[
                                estadoSelect.selectedIndex
                            ]
                            ?.text
                            ?.trim() ?? '';


                    /*
                     * Validación visual.
                     */

                    if (
                        !cantidad ||
                        !descripcion ||
                        !codigo ||
                        !marca ||
                        !color ||
                        !medida ||
                        !clase ||
                        !observaciones ||
                        !estadoId
                    ) {

                        window.alert(
                            'Completa todos los campos del elemento EPP TR.'
                        );

                        return;
                    }


                    if (
                        !Number.isInteger(Number(cantidad)) ||
                        Number(cantidad) < 1
                    ) {

                        window.alert(
                            'La cantidad debe ser un número entero mayor a cero.'
                        );

                        return;
                    }


                    /*
                     * Quitar mensaje vacío.
                     */

                    document
                        .getElementById('tr-vacio')
                        ?.remove();


                    /*
                     * Crear fila visible.
                     */

                    const fila =
                        document.createElement('tr');

                    fila.dataset.indiceTr =
                        String(indiceTr);

                    fila.innerHTML = `
                        <td>
                            ${escaparHtml(cantidad)}
                        </td>

                        <td>
                            ${escaparHtml(descripcion)}
                        </td>

                        <td>
                            ${escaparHtml(codigo)}
                        </td>

                        <td>
                            ${escaparHtml(marca)}
                        </td>

                        <td>
                            ${escaparHtml(color)}
                        </td>

                        <td>
                            ${escaparHtml(medida)}
                        </td>

                        <td>
                            ${escaparHtml(clase)}
                        </td>

                        <td>
                            ${escaparHtml(estadoNombre)}
                        </td>

                        <td>
                            <button
                                type="button"
                                class="btn btn-eliminar"
                                data-quitar-tr="${indiceTr}"
                            >
                                Quitar
                            </button>
                        </td>
                    `;

                    listaElementosTr.appendChild(fila);


                    /*
                     * Crear los campos ocultos enviados a Laravel.
                     */

                    const bloque =
                        document.createElement('div');

                    bloque.dataset.detalleTr =
                        String(indiceTr);

                    bloque.innerHTML = `
                        <input
                            type="hidden"
                            name="detalles_tr[${indiceTr}][cantidad]"
                            value="${escaparAtributo(cantidad)}"
                        >

                        <input
                            type="hidden"
                            name="detalles_tr[${indiceTr}][descripcion]"
                            value="${escaparAtributo(descripcion)}"
                        >

                        <input
                            type="hidden"
                            name="detalles_tr[${indiceTr}][codigo]"
                            value="${escaparAtributo(codigo)}"
                        >

                        <input
                            type="hidden"
                            name="detalles_tr[${indiceTr}][marca]"
                            value="${escaparAtributo(marca)}"
                        >

                        <input
                            type="hidden"
                            name="detalles_tr[${indiceTr}][color]"
                            value="${escaparAtributo(color)}"
                        >

                        <input
                            type="hidden"
                            name="detalles_tr[${indiceTr}][medida]"
                            value="${escaparAtributo(medida)}"
                        >

                        <input
                            type="hidden"
                            name="detalles_tr[${indiceTr}][clase]"
                            value="${escaparAtributo(clase)}"
                        >

                        <input
                            type="hidden"
                            name="detalles_tr[${indiceTr}][observaciones]"
                            value="${escaparAtributo(observaciones)}"
                        >

                        <input
                            type="hidden"
                            name="detalles_tr[${indiceTr}][estado_id]"
                            value="${escaparAtributo(estadoId)}"
                        >
                    `;

                    inputsOcultosTr.appendChild(bloque);

                    indiceTr++;

                    limpiarFormularioTr();

                    actualizarTablaVaciaTr();
                }
            );


            /*
            |--------------------------------------------------------------------------
            | Quitar elemento EppTr
            |--------------------------------------------------------------------------
            */

            listaElementosTr?.addEventListener(
                'click',
                function (event) {

                    const boton =
                        event.target.closest(
                            '[data-quitar-tr]'
                        );

                    if (!boton) {
                        return;
                    }

                    const indice =
                        boton.dataset.quitarTr;


                    listaElementosTr
                        .querySelector(
                            `tr[data-indice-tr="${indice}"]`
                        )
                        ?.remove();


                    inputsOcultosTr
                        .querySelector(
                            `[data-detalle-tr="${indice}"]`
                        )
                        ?.remove();


                    actualizarTablaVaciaTr();
                }
            );


            /*
            |--------------------------------------------------------------------------
            | Validar antes de enviar
            |--------------------------------------------------------------------------
            */

            formulario?.addEventListener(
                'submit',
                function (event) {

                    const tipo =
                        obtenerTipoSeleccionado();


                    /*
                     * Por ahora la validación de elementos existe
                     * únicamente para EppTr.
                     */

                    if (tipo !== 'epptr') {
                        return;
                    }


                    const totalDetalles =
                        inputsOcultosTr
                            ?.querySelectorAll(
                                '[data-detalle-tr]'
                            )
                            .length ?? 0;


                    if (totalDetalles === 0) {

                        event.preventDefault();

                        window.alert(
                            'Debes agregar al menos un elemento EPP TR.'
                        );


                        seccionTr?.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start',
                        });
                    }

                }
            );

        });
    </script>

</body>

</html>