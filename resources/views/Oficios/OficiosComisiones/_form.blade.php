@php
    $detalleComision = $detalleComision ?? null;

    $valor = function ($campo, $predeterminado = '') use ($detalleComision) {
        return old(
            'comisiones.' . $campo,
            $detalleComision ? $detalleComision->{$campo} : $predeterminado
        );
    };

    $fechaHora = function ($campo) use ($valor) {
        $fecha = $valor($campo);

        if (!$fecha) {
            return '';
        }

        return \Illuminate\Support\Carbon::parse($fecha)->format('Y-m-d\TH:i');
    };
@endphp

<h2 class="formulario-seccion-titulo">
    Datos de comisiones
</h2>

<div class="formulario-grid">

    {{-- DÍAS --}}

    <div class="campo">
        <label for="comision_dias">
            Días de comisión
        </label>

        <input
            type="number"
            id="comision_dias"
            name="comisiones[dias]"
            min="1"
            value="{{ $valor('dias') }}"
            required
        >
    </div>

    {{-- COMISIÓN --}}

    <div class="campo">
        <label for="comision_descripcion">
            Comisión
        </label>

        <textarea
            id="comision_descripcion"
            name="comisiones[comision]"
            rows="4"
            required
        >{{ $valor('comision') }}</textarea>
    </div>

    {{-- CIUDAD DESTINO --}}

    <div class="campo">
        <label for="comision_ciudad_destino">
            Ciudad destino
        </label>

        <textarea
            id="comision_ciudad_destino"
            name="comisiones[ciudad_destino]"
            rows="3"
            required
        >{{ $valor('ciudad_destino') }}</textarea>
    </div>

    {{-- FECHAS Y HORAS --}}

    <div class="campo">
        <label for="comision_fecha_inicio">
            Fecha y hora de inicio
        </label>

        <input
            type="datetime-local"
            id="comision_fecha_inicio"
            name="comisiones[fecha_hora_inicio]"
            value="{{ $fechaHora('fecha_hora_inicio') }}"
            required
        >
    </div>

    <div class="campo">
        <label for="comision_fecha_termino">
            Fecha y hora de término
        </label>

        <input
            type="datetime-local"
            id="comision_fecha_termino"
            name="comisiones[fecha_hora_termino]"
            value="{{ $fechaHora('fecha_hora_termino') }}"
            required
        >
    </div>

</div>