@php
    $detalleRuta = $detalleRuta ?? null;

    $valor = function ($campo, $predeterminado = '') use ($detalleRuta) {
        return old(
            'rutas.' . $campo,
            $detalleRuta ? $detalleRuta->{$campo} : $predeterminado
        );
    };
@endphp

<h2 class="formulario-seccion-titulo">
    Datos de rutas
</h2>

<div class="formulario-grid">

    {{-- FOLIO AC --}}

    <div class="campo">
        <label for="ruta_folio_ac">
            Folio AC
        </label>

        <input
            type="text"
            id="ruta_folio_ac"
            name="rutas[folio_ac]"
            value="{{ $valor('folio_ac') }}"
            required
        >
    </div>

    {{-- RUTA --}}

    <div class="campo">
        <label for="ruta_nombre">
            Ruta
        </label>

        <input
            type="text"
            id="ruta_nombre"
            name="rutas[ruta]"
            value="{{ $valor('ruta') }}"
            required
        >
    </div>

    {{-- TRABAJADOR --}}

    <div class="campo">
        <label for="ruta_trabajador_id">
            Trabajador
        </label>

        <select
            id="ruta_trabajador_id"
            name="rutas[trabajador_id]"
            required
        >
            <option value="">
                Selecciona un trabajador
            </option>

            @foreach ($trabajadores as $trabajador)
                <option
                    value="{{ $trabajador->id }}"
                    @selected($valor('trabajador_id') == $trabajador->id)
                >
                    {{ $trabajador->nombre }}
                    {{ $trabajador->apellido_paterno }}
                    {{ $trabajador->apellido_materno }}
                </option>
            @endforeach
        </select>
    </div>

    {{-- TIPO --}}

    <div class="campo">
        <label for="ruta_tipo">
            Tipo
        </label>

        <select
            id="ruta_tipo"
            name="rutas[tipo]"
            required
        >
            <option value="">
                Selecciona un tipo
            </option>

            <option
                value="aviso ordinario"
                @selected($valor('tipo') == 'aviso ordinario')
            >
                Aviso ordinario
            </option>

            <option
                value="aviso de requisicion"
                @selected($valor('tipo') == 'aviso de requisicion')
            >
                Aviso de requisición
            </option>

            <option
                value="solicitud de anticipo"
                @selected($valor('tipo') == 'solicitud de anticipo')
            >
                Solicitud de anticipo
            </option>
        </select>
    </div>

    {{-- CARTA PORTE --}}

    <div class="campo">
        <label for="ruta_carta_porte">
            Carta porte
        </label>

        <input
            type="text"
            id="ruta_carta_porte"
            name="rutas[carta_porte]"
            value="{{ $valor('carta_porte') }}"
            required
        >
    </div>

    {{-- FACTURA --}}

    <div class="campo">
        <label for="ruta_factura">
            ¿Cuenta con factura?
        </label>

        <select
            id="ruta_factura"
            name="rutas[factura]"
            required
        >
            <option value="">
                Selecciona una opción
            </option>

            <option
                value="1"
                @selected((string) $valor('factura') === '1')
            >
                Sí
            </option>

            <option
                value="0"
                @selected((string) $valor('factura') === '0')
            >
                No
            </option>
        </select>
    </div>

    {{-- NÚMERO DE RECOLECCIÓN --}}

    <div class="campo">
        <label for="ruta_no_recoleccion">
            Número de recolección
        </label>

        <input
            type="number"
            id="ruta_no_recoleccion"
            name="rutas[no_recoleccion]"
            min="0"
            value="{{ $valor('no_recoleccion') }}"
            required
        >
    </div>

    {{-- OBSERVACIONES --}}

    <div class="campo">
        <label for="ruta_observaciones">
            Observaciones
        </label>

        <textarea
            id="ruta_observaciones"
            name="rutas[observaciones]"
            rows="3"
            required
        >{{ $valor('observaciones') }}</textarea>
    </div>

</div>