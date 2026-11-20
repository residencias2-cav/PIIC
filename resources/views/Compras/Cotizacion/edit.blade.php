
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Editar cotización</title>

    <link rel="stylesheet" href="{{ asset('css/catalogos.css') }}">
</head>

<body>

<main class="formulario-card">

    <header class="formulario-header">
        <h1>Editar cotización</h1>
        <p>Modifica los datos generales y los conceptos de la cotización.</p>
    </header>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Revisa los siguientes errores:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('compras.cotizaciones.update', $cotizacion->id) }}"
          method="POST">

        @csrf
        @method('PUT')

        <h2>Datos generales</h2>

        <div class="formulario-grid">

            <div class="form-group">
                <label>Pedido</label>
                <select name="pedido_id" required>
                    <option value="">Selecciona un pedido</option>
                    @foreach ($pedidos as $pedido)
                        <option value="{{ $pedido->id }}"
                            {{ old('pedido_id', $cotizacion->pedido_id) == $pedido->id ? 'selected' : '' }}>
                            Pedido #{{ $pedido->id }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Fecha</label>
                <input type="date" name="fecha"
                       value="{{ old('fecha', $cotizacion->fecha?->format('Y-m-d')) }}"
                       required>
            </div>

            <div class="form-group">
                <label>Gerencia</label>
                <select name="gerencia_id" required>
                    <option value="">Selecciona una gerencia</option>
                    @foreach ($gerencias as $gerencia)
                        <option value="{{ $gerencia->id }}"
                            {{ old('gerencia_id', $cotizacion->gerencia_id) == $gerencia->id ? 'selected' : '' }}>
                            {{ $gerencia->nombre ?? 'Gerencia '.$gerencia->id }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Folio</label>
                <input type="text" name="folio" maxlength="20"
                       value="{{ old('folio', $cotizacion->folio) }}" required>
            </div>

            <div class="form-group">
                <label>Folio de compra</label>
                <select name="folio_compra_id" required>
                    <option value="">Selecciona un folio</option>
                    @foreach ($foliosCompras as $folio)
                        <option value="{{ $folio->id }}"
                            {{ old('folio_compra_id', $cotizacion->folio_compra_id) == $folio->id ? 'selected' : '' }}>
                            {{ $folio->folio }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Fecha de compras</label>
                <input type="date" name="fecha_compras"
                       value="{{ old('fecha_compras', $cotizacion->fecha_compras?->format('Y-m-d')) }}"
                       required>
            </div>

            <div class="form-group">
                <label>Fecha de solicitud</label>
                <input type="date" name="fecha_solicitud"
                       value="{{ old('fecha_solicitud', $cotizacion->fecha_solicitud?->format('Y-m-d')) }}"
                       required>
            </div>

            <div class="form-group">
                <label>Fecha requerida</label>
                <input type="date" name="fecha_requerido"
                       value="{{ old('fecha_requerido', $cotizacion->fecha_requerido?->format('Y-m-d')) }}"
                       required>
            </div>

            <div class="form-group">
                <label>Fecha de recibido</label>
                <input type="date" name="fecha_recibido"
                       value="{{ old('fecha_recibido', $cotizacion->fecha_recibido?->format('Y-m-d')) }}"
                       required>
            </div>

            <div class="form-group">
                <label>Proyecto</label>
                <select name="proyecto_id" required>
                    <option value="">Selecciona un proyecto</option>
                    @foreach ($proyectos as $proyecto)
                        <option value="{{ $proyecto->id }}"
                            {{ old('proyecto_id', $cotizacion->proyecto_id) == $proyecto->id ? 'selected' : '' }}>
                            {{ $proyecto->nombre ?? 'Proyecto '.$proyecto->id }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Obra</label>
                <select name="obra_id" required>
                    <option value="">Selecciona una obra</option>
                    @foreach ($obras as $obra)
                        <option value="{{ $obra->id }}"
                            {{ old('obra_id', $cotizacion->obra_id) == $obra->id ? 'selected' : '' }}>
                            {{ $obra->nombre ?? 'Obra '.$obra->id }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Lugar</label>
                <select name="lugar_id" required>
                    <option value="">Selecciona un lugar</option>
                    @foreach ($lugares as $lugar)
                        <option value="{{ $lugar->id }}"
                            {{ old('lugar_id', $cotizacion->lugar_id) == $lugar->id ? 'selected' : '' }}>
                            {{ $lugar->nombre ?? 'Lugar '.$lugar->id }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Tipo de cotización</label>
                <select name="tipo_cotizacion_id" required>
                    <option value="">Selecciona un tipo</option>
                    @foreach ($tiposCotizacion as $tipo)
                        <option value="{{ $tipo->id }}"
                            {{ old('tipo_cotizacion_id', $cotizacion->tipo_cotizacion_id) == $tipo->id ? 'selected' : '' }}>
                            {{ $tipo->nombre ?? 'Tipo '.$tipo->id }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Estado del pedido</label>
                <select name="estado_pedido_id" required>
                    <option value="">Selecciona un estado</option>
                    @foreach ($estadosPedido as $estado)
                        <option value="{{ $estado->id }}"
                            {{ old('estado_pedido_id', $cotizacion->estado_pedido_id) == $estado->id ? 'selected' : '' }}>
                            {{ $estado->nombre ?? $estado->nombre_estado ?? 'Estado '.$estado->id }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Notas</label>
                <textarea name="notas" maxlength="100" required>{{ old('notas', $cotizacion->notas) }}</textarea>
            </div>

        </div>

        <hr>

        <h2>Detalles de la cotización</h2>

        <div id="detalles-container">

            @foreach ($cotizacion->datosCotizacion as $i => $detalle)

                <div class="detalle-item">

                    <h3>Concepto {{ $i + 1 }}</h3>

                    <input type="hidden"
                           name="datos_cotizacion[{{ $i }}][id]"
                           value="{{ $detalle->id }}">

                    <div class="formulario-grid">

                        <div class="form-group">
                            <label>Unidad</label>
                            <select name="datos_cotizacion[{{ $i }}][unidad_id]" required>
                                <option value="">Selecciona una unidad</option>
                                @foreach ($unidades as $unidad)
                                    <option value="{{ $unidad->id }}"
                                        {{ $detalle->unidad_id == $unidad->id ? 'selected' : '' }}>
                                        {{ $unidad->nombre ?? 'Unidad '.$unidad->id }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Descripción</label>
                            <input type="text"
                                   name="datos_cotizacion[{{ $i }}][descripcion]"
                                   maxlength="150"
                                   value="{{ $detalle->descripcion }}"
                                   required>
                        </div>

                        <div class="form-group">
                            <label>Código</label>
                            <input type="text"
                                   name="datos_cotizacion[{{ $i }}][codigo]"
                                   maxlength="150"
                                   value="{{ $detalle->codigo }}"
                                   required>
                        </div>

                        <div class="form-group">
                            <label>Fecha requerida</label>
                            <input type="text"
                                   name="datos_cotizacion[{{ $i }}][fecha_r]"
                                   maxlength="150"
                                   value="{{ $detalle->fecha_r }}"
                                   required>
                        </div>

                        <div class="form-group">
                            <label>¿Entregado?</label>
                            <select name="datos_cotizacion[{{ $i }}][entregado]" required>
                                <option value="0" {{ !$detalle->entregado ? 'selected' : '' }}>No</option>
                                <option value="1" {{ $detalle->entregado ? 'selected' : '' }}>Sí</option>
                            </select>
                        </div>

                    </div>

                    <button type="button" class="eliminar-detalle">
                        Eliminar concepto
                    </button>

                </div>

            @endforeach

        </div>

        <button type="button" id="agregar-detalle">
            Agregar otro concepto
        </button>

        <div class="formulario-botones">

            <button type="submit">Actualizar cotización</button>

            <a href="{{ route('compras.cotizaciones.index') }}">
                Cancelar
            </a>

        </div>

    </form>

</main>

<script>
    let contador = {{ $cotizacion->datosCotizacion->count() }};

    const container = document.getElementById('detalles-container');

    function activarBotonesEliminar() {
        document.querySelectorAll('.eliminar-detalle').forEach(boton => {
            boton.onclick = function () {
                boton.closest('.detalle-item').remove();
            };
        });
    }

    activarBotonesEliminar();

    document.getElementById('agregar-detalle').addEventListener('click', function () {

        const detalle = document.createElement('div');

        detalle.classList.add('detalle-item');

        detalle.innerHTML = `
            <hr>
            <h3>Concepto ${contador + 1}</h3>

            <div class="formulario-grid">

                <div class="form-group">
                    <label>Unidad</label>
                    <select name="datos_cotizacion[${contador}][unidad_id]" required>
                        <option value="">Selecciona una unidad</option>
                        @foreach ($unidades as $unidad)
                            <option value="{{ $unidad->id }}">
                                {{ $unidad->nombre ?? 'Unidad '.$unidad->id }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Descripción</label>
                    <input type="text" name="datos_cotizacion[${contador}][descripcion]" maxlength="150" required>
                </div>

                <div class="form-group">
                    <label>Código</label>
                    <input type="text" name="datos_cotizacion[${contador}][codigo]" maxlength="150" required>
                </div>

                <div class="form-group">
                    <label>Fecha requerida</label>
                    <input type="text" name="datos_cotizacion[${contador}][fecha_r]" maxlength="150" required>
                </div>

                <div class="form-group">
                    <label>¿Entregado?</label>
                    <select name="datos_cotizacion[${contador}][entregado]" required>
                        <option value="0">No</option>
                        <option value="1">Sí</option>
                    </select>
                </div>

            </div>

            <button type="button" class="eliminar-detalle">
                Eliminar concepto
            </button>
        `;

        container.appendChild(detalle);

        activarBotonesEliminar();

        contador++;
    });
</script>

</body>
</html>
