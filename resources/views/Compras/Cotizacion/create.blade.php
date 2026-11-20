
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Registrar cotización</title>

    <link rel="stylesheet" href="{{ asset('css/catalogos.css') }}">
</head>

<body>

<main class="formulario-card">

    <header class="formulario-header">
        <h1>Registrar cotización</h1>
        <p>Ingresa los datos generales y los conceptos de la cotización.</p>
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

    <form action="{{ route('compras.cotizaciones.store') }}"
          method="POST">

        @csrf

        <h2>Datos generales</h2>

        <div class="formulario-grid">

            <div class="form-group">
                <label for="pedido_id">Pedido</label>
                <select name="pedido_id" id="pedido_id" required>
                    <option value="">Selecciona un pedido</option>
                    @foreach ($pedidos as $pedido)
                        <option value="{{ $pedido->id }}"
                            {{ old('pedido_id') == $pedido->id ? 'selected' : '' }}>
                            Pedido #{{ $pedido->id }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="fecha">Fecha</label>
                <input type="date" name="fecha" id="fecha"
                       value="{{ old('fecha') }}" required>
            </div>

            <div class="form-group">
                <label for="gerencia_id">Gerencia</label>
                <select name="gerencia_id" id="gerencia_id" required>
                    <option value="">Selecciona una gerencia</option>
                    @foreach ($gerencias as $gerencia)
                        <option value="{{ $gerencia->id }}"
                            {{ old('gerencia_id') == $gerencia->id ? 'selected' : '' }}>
                            {{ $gerencia->nombre ?? 'Gerencia '.$gerencia->id }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="folio">Folio</label>
                <input type="text" name="folio" id="folio"
                       maxlength="20" value="{{ old('folio') }}" required>
            </div>

            <div class="form-group">
                <label for="folio_compra_id">Folio de compra</label>
                <select name="folio_compra_id" id="folio_compra_id" required>
                    <option value="">Selecciona un folio</option>
                    @foreach ($foliosCompras as $folio)
                        <option value="{{ $folio->id }}"
                            {{ old('folio_compra_id') == $folio->id ? 'selected' : '' }}>
                            {{ $folio->folio }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="fecha_compras">Fecha de compras</label>
                <input type="date" name="fecha_compras" id="fecha_compras"
                       value="{{ old('fecha_compras') }}" required>
            </div>

            <div class="form-group">
                <label for="fecha_solicitud">Fecha de solicitud</label>
                <input type="date" name="fecha_solicitud" id="fecha_solicitud"
                       value="{{ old('fecha_solicitud') }}" required>
            </div>

            <div class="form-group">
                <label for="fecha_requerido">Fecha requerida</label>
                <input type="date" name="fecha_requerido" id="fecha_requerido"
                       value="{{ old('fecha_requerido') }}" required>
            </div>

            <div class="form-group">
                <label for="fecha_recibido">Fecha de recibido</label>
                <input type="date" name="fecha_recibido" id="fecha_recibido"
                       value="{{ old('fecha_recibido') }}" required>
            </div>

            <div class="form-group">
                <label for="proyecto_id">Proyecto</label>
                <select name="proyecto_id" id="proyecto_id" required>
                    <option value="">Selecciona un proyecto</option>
                    @foreach ($proyectos as $proyecto)
                        <option value="{{ $proyecto->id }}"
                            {{ old('proyecto_id') == $proyecto->id ? 'selected' : '' }}>
                            {{ $proyecto->nombre ?? 'Proyecto '.$proyecto->id }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="obra_id">Obra</label>
                <select name="obra_id" id="obra_id" required>
                    <option value="">Selecciona una obra</option>
                    @foreach ($obras as $obra)
                        <option value="{{ $obra->id }}"
                            {{ old('obra_id') == $obra->id ? 'selected' : '' }}>
                            {{ $obra->nombre ?? 'Obra '.$obra->id }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="lugar_id">Lugar</label>
                <select name="lugar_id" id="lugar_id" required>
                    <option value="">Selecciona un lugar</option>
                    @foreach ($lugares as $lugar)
                        <option value="{{ $lugar->id }}"
                            {{ old('lugar_id') == $lugar->id ? 'selected' : '' }}>
                            {{ $lugar->nombre ?? 'Lugar '.$lugar->id }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="tipo_cotizacion_id">Tipo de cotización</label>
                <select name="tipo_cotizacion_id" id="tipo_cotizacion_id" required>
                    <option value="">Selecciona un tipo</option>
                    @foreach ($tiposCotizacion as $tipo)
                        <option value="{{ $tipo->id }}"
                            {{ old('tipo_cotizacion_id') == $tipo->id ? 'selected' : '' }}>
                            {{ $tipo->nombre ?? 'Tipo '.$tipo->id }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="estado_pedido_id">Estado del pedido</label>
                <select name="estado_pedido_id" id="estado_pedido_id" required>
                    <option value="">Selecciona un estado</option>
                    @foreach ($estadosPedido as $estado)
                        <option value="{{ $estado->id }}"
                            {{ old('estado_pedido_id') == $estado->id ? 'selected' : '' }}>
                            {{ $estado->nombre ?? $estado->nombre_estado ?? 'Estado '.$estado->id }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="notas">Notas</label>
                <textarea name="notas" id="notas"
                          maxlength="100" required>{{ old('notas') }}</textarea>
            </div>

            <input type="hidden" name="created_by"
                   value="{{ old('created_by', auth()->id()) }}">

        </div>

        <hr>

        <h2>Detalles de la cotización</h2>

        <div id="detalles-container">

            <div class="detalle-item">

                <h3>Concepto 1</h3>

                <div class="formulario-grid">

                    <div class="form-group">
                        <label>Unidad</label>
                        <select name="datos_cotizacion[0][unidad_id]" required>
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
                        <input type="text"
                               name="datos_cotizacion[0][descripcion]"
                               maxlength="150" required>
                    </div>

                    <div class="form-group">
                        <label>Código</label>
                        <input type="text"
                               name="datos_cotizacion[0][codigo]"
                               maxlength="150" required>
                    </div>

                    <div class="form-group">
                        <label>Fecha requerida</label>
                        <input type="text"
                               name="datos_cotizacion[0][fecha_r]"
                               maxlength="150" required>
                    </div>

                    <div class="form-group">
                        <label>¿Entregado?</label>
                        <select name="datos_cotizacion[0][entregado]" required>
                            <option value="0">No</option>
                            <option value="1">Sí</option>
                        </select>
                    </div>

                </div>

            </div>

        </div>

        <button type="button" id="agregar-detalle">
            Agregar otro concepto
        </button>

        <div class="formulario-botones">
            <button type="submit">Guardar cotización</button>

            <a href="{{ route('compras.cotizaciones.index') }}">
                Cancelar
            </a>
        </div>

    </form>

</main>

<script>
    let contador = 1;

    document.getElementById('agregar-detalle').addEventListener('click', function () {

        const container = document.getElementById('detalles-container');

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
                    <input type="text"
                           name="datos_cotizacion[${contador}][descripcion]"
                           maxlength="150" required>
                </div>

                <div class="form-group">
                    <label>Código</label>
                    <input type="text"
                           name="datos_cotizacion[${contador}][codigo]"
                           maxlength="150" required>
                </div>

                <div class="form-group">
                    <label>Fecha requerida</label>
                    <input type="text"
                           name="datos_cotizacion[${contador}][fecha_r]"
                           maxlength="150" required>
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
        contador++;

        detalle.querySelector('.eliminar-detalle').addEventListener('click', function () {
            detalle.remove();
        });
    });
</script>

</body>
</html>
