<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar dato de cotización</title>
    <link rel="stylesheet" href="{{ asset('css/catalogos.css') }}">
</head>
<body>

<main class="catalogo-contenedor">

    <section class="formulario-card">

        <header class="formulario-header">
            <div class="catalogo-linea"></div>
            <div>
                <h1 class="formulario-titulo">Editar dato de cotización</h1>
                <p class="formulario-descripcion">
                    Modifica la información del concepto o producto de la cotización.
                </p>
            </div>
        </header>

        @if($errors->any())
            <div class="mensaje-error">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('datos_cotizacion.update', $datos_cotizacion->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="formulario-seccion">
                <h2 class="formulario-seccion-titulo">Información del dato</h2>

                <div class="formulario-grid">

                    <div class="campo">
                        <label for="cotizacion_id">Cotización</label>
                        <select name="cotizacion_id" id="cotizacion_id" required>
                            <option value="">Selecciona una cotización</option>
                            @foreach($cotizaciones as $cotizacion)
                                <option value="{{ $cotizacion->id }}"
                                    {{ old('cotizacion_id', $datos_cotizacion->cotizacion_id) == $cotizacion->id ? 'selected' : '' }}>
                                    {{ $cotizacion->folio ?? 'Cotización #' . $cotizacion->id }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="campo">
                        <label for="unidad_id">Unidad</label>
                        <select name="unidad_id" id="unidad_id" required>
                            <option value="">Selecciona una unidad</option>
                            @foreach($unidades as $unidad)
                                <option value="{{ $unidad->id }}"
                                    {{ old('unidad_id', $datos_cotizacion->unidad_id) == $unidad->id ? 'selected' : '' }}>
                                    {{ $unidad->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="campo">
                        <label for="descripcion">Descripción</label>
                        <input
                            type="text"
                            name="descripcion"
                            id="descripcion"
                            maxlength="150"
                            value="{{ old('descripcion', $datos_cotizacion->descripcion) }}"
                            required
                        >
                    </div>

                    <div class="campo">
                        <label for="codigo">Código</label>
                        <input
                            type="text"
                            name="codigo"
                            id="codigo"
                            maxlength="150"
                            value="{{ old('codigo', $datos_cotizacion->codigo) }}"
                            required
                        >
                    </div>

                    <div class="campo">
                        <label for="entregado">¿Entregado?</label>
                        <select name="entregado" id="entregado" required>
                            <option value="1"
                                {{ old('entregado', $datos_cotizacion->entregado) == '1' ? 'selected' : '' }}>
                                Sí
                            </option>
                            <option value="0"
                                {{ old('entregado', $datos_cotizacion->entregado) == '0' ? 'selected' : '' }}>
                                No
                            </option>
                        </select>
                    </div>

                    <div class="campo">
                        <label for="fecha_r">Fecha de recepción</label>
                        <input
                            type="text"
                            name="fecha_r"
                            id="fecha_r"
                            maxlength="150"
                            value="{{ old('fecha_r', $datos_cotizacion->fecha_r) }}"
                            placeholder="Ej. 25/11/2026"
                            required
                        >
                    </div>

                </div>
            </div>

            <div class="formulario-acciones">
                <a href="{{ route('datos_cotizacion.index') }}" class="btn btn-secundario">
                    Cancelar
                </a>

                <button type="submit" class="btn btn-principal">
                    Actualizar dato
                </button>
            </div>

        </form>

    </section>

</main>

</body>
</html>