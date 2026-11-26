<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Registrar pedido</title>

    <link rel="stylesheet" href="{{ asset('css/catalogos.css') }}">
</head>

<body>

<main class="formulario-card">

    <header class="formulario-header">
        <div class="catalogo-linea"></div>

        <div>
            <h1 class="formulario-titulo">Registrar pedido</h1>
            <p class="formulario-descripcion">
                Ingresa la información general del pedido.
            </p>
        </div>

                <a href="{{ route('pedido.index') }}" class="btn btn-eliminar">
                    ← Regresar a pedidos
                </a>
        
    </header>

    @if ($errors->any())
        <div class="mensaje-error">
            <strong>Revisa la información:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    

    <form action="{{ route('pedido.store') }}" method="POST">
        @csrf

        {{-- IDENTIFICACIÓN --}}
        <section class="formulario-seccion">
            <h2 class="formulario-seccion-titulo">Identificación</h2>

            <div class="formulario-grid">

                <div class="campo campo-bloqueado">
                    <label for="fecha_visual">Fecha</label>

                    <input
                        type="date"
                        id="fecha_visual"
                        value="{{ old('fecha', now()->toDateString()) }}"
                        readonly
                    >

                    <input
                        type="hidden"
                        name="fecha"
                        value="{{ old('fecha', now()->toDateString()) }}"
                    >
                </div>

                <div class="campo campo-bloqueado">
                    <label for="folio_visual">Folio</label>

                    <input
                        type="text"
                        id="folio_visual"
                        value="{{ old('folio', $siguienteFolio) }}"
                        readonly
                    >

                    <input
                        type="hidden"
                        name="folio"
                        value="{{ old('folio', $siguienteFolio) }}"
                    >
                </div>

            </div>
        </section>

        {{-- CLASIFICACIÓN --}}
        <section class="formulario-seccion">
            <h2 class="formulario-seccion-titulo">Clasificación</h2>

            <div class="formulario-grid">

                <div class="campo">
                    <label for="tipo_pedido_id">Tipo de pedido</label>

                    <select id="tipo_pedido_id" name="tipo_pedido_id" required>
                        <option value="">Selecciona un tipo de pedido</option>

                        @foreach ($tiposPedido as $tipoPedido)
                            <option
                                value="{{ $tipoPedido->id }}"
                                data-nombre="{{ strtolower(trim($tipoPedido->nombre)) }}"
                                @selected(old('tipo_pedido_id') == $tipoPedido->id)
                            >
                                {{ $tipoPedido->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="campo">
                    <label for="tipo_compra_id">Tipo de compra</label>

                    <select id="tipo_compra_id" name="tipo_compra_id" required>
                        <option value="">Selecciona un tipo de compra</option>

                        @foreach ($tiposCompra as $tipoCompra)
                            <option
                                value="{{ $tipoCompra->id }}"
                                @selected(old('tipo_compra_id') == $tipoCompra->id)
                            >
                                {{ $tipoCompra->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>

            </div>

            <div class="campo">
                <label for="estado_id">Estado</label>

                <select id="estado_id" name="estado_id" required>
                    <option value="">Selecciona un estado</option>

                    @foreach ($estados as $estado)
                        <option
                            value="{{ $estado->id }}"
                            @selected(old('estado_id') == $estado->id)
                        >
                            {{ $estado->nombre_estado }}
                        </option>
                    @endforeach
                </select>
            </div>
        </section>

        {{-- ORIGEN --}}
        <section class="formulario-seccion">
            <h2 class="formulario-seccion-titulo">Origen</h2>

            <div class="formulario-grid">

                <div class="campo">
                    <label for="gerencia_id">Gerencia</label>

                    <select id="gerencia_id" name="gerencia_id" required>
                        <option value="">Selecciona una gerencia</option>

                        @foreach ($gerencias as $gerencia)
                            <option
                                value="{{ $gerencia->id }}"
                                @selected(old('gerencia_id') == $gerencia->id)
                            >
                                {{ $gerencia->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="campo">
                    <label for="empresa_id">Empresa</label>

                    <select id="empresa_id" name="empresa_id" required>
                        <option value="">Selecciona una empresa</option>

                        @foreach ($empresas as $empresa)
                            <option
                                value="{{ $empresa->id }}"
                                @selected(old('empresa_id') == $empresa->id)
                            >
                                {{ $empresa->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>

            </div>

            <div class="formulario-grid">

                <div class="campo">
                    <label for="proyecto_id">Proyecto</label>

                    <select id="proyecto_id" name="proyecto_id" required>
                        <option value="">Selecciona un proyecto</option>

                        @foreach ($proyectos as $proyecto)
                            <option
                                value="{{ $proyecto->id }}"
                                @selected(old('proyecto_id') == $proyecto->id)
                            >
                                {{ $proyecto->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="campo">
                    <label for="ubicacion_id">Ubicación</label>

                    <select id="ubicacion_id" name="ubicacion_id" required>
                        <option value="">Selecciona una ubicación</option>

                        @foreach ($ubicaciones as $ubicacion)
                            <option
                                value="{{ $ubicacion->id }}"
                                @selected(old('ubicacion_id') == $ubicacion->id)
                            >
                                {{ $ubicacion->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>

            </div>
        </section>

        {{-- INFORMACIÓN ECONÓMICA --}}
        <section class="formulario-seccion">
            <h2 class="formulario-seccion-titulo">Información económica</h2>

            <div class="formulario-grid">

                <div class="campo">
                    <label for="monto_credito">Monto de crédito</label>

                    <input
                        type="number"
                        id="monto_credito"
                        name="monto_credito"
                        value="{{ old('monto_credito') }}"
                        min="0"
                        step="1"
                        placeholder="0"
                        required
                    >
                </div>

                <div class="campo">
                    <label for="monto">Monto</label>

                    <input
                        type="number"
                        id="monto"
                        name="monto"
                        value="{{ old('monto') }}"
                        min="0"
                        step="1"
                        placeholder="0"
                        required
                    >
                </div>

            </div>
        </section>

        {{-- OBSERVACIONES --}}
        <section class="formulario-seccion">
            <h2 class="formulario-seccion-titulo">Detalle</h2>

            <div class="campo">
                <label for="observaciones">Observaciones</label>

                <textarea
                    id="observaciones"
                    name="observaciones"
                    rows="4"
                    maxlength="200"
                    placeholder="Observaciones del pedido"
                    required
                >{{ old('observaciones') }}</textarea>
            </div>
        </section>

        {{-- PEDIDO INTERNO --}}
        <section
            id="seccion-pedido-interno"
            class="formulario-seccion"
            style="display: none;"
        >
            <h2 class="formulario-seccion-titulo">
                Información del pedido interno
            </h2>

            <div class="formulario-grid">

                <div class="campo">
                    <label for="tipo_servicio_id">Tipo de servicio</label>

                    <select
                        id="tipo_servicio_id"
                        name="pedido_interno[tipo_servicio_id]"
                        data-required="true"
                    >
                        <option value="">Selecciona un tipo de servicio</option>

                        @foreach ($tiposServicio as $tipoServicio)
                            <option
                                value="{{ $tipoServicio->id }}"
                                @selected(old('pedido_interno.tipo_servicio_id') == $tipoServicio->id)
                            >
                                {{ $tipoServicio->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="campo">
                    <label for="fecha_entrega">Fecha de entrega</label>

                    <input
                        type="date"
                        id="fecha_entrega"
                        name="pedido_interno[fecha_entrega]"
                        value="{{ old('pedido_interno.fecha_entrega') }}"
                        data-required="true"
                    >
                </div>

            </div>

            <div class="campo">
                <label for="fecha_devolucion">Fecha de devolución</label>

                <input
                    type="date"
                    id="fecha_devolucion"
                    name="pedido_interno[fecha_devolucion]"
                    value="{{ old('pedido_interno.fecha_devolucion') }}"
                    data-required="true"
                >
            </div>

            <div class="campo">
                <label for="descripcion_interna">Descripción</label>

                <textarea
                    id="descripcion_interna"
                    name="pedido_interno[descripcion]"
                    rows="3"
                    maxlength="100"
                    data-required="true"
                >{{ old('pedido_interno.descripcion') }}</textarea>
            </div>
        </section>

        {{-- PEDIDO ALM --}}
        <section
            id="seccion-pedido-alm"
            class="formulario-seccion"
            style="display: none;"
        >
            <h2 class="formulario-seccion-titulo">
                Detalle de partidas del pedido ALM
            </h2>

            <div id="contenedor-partidas">

                @php
                    $partidasAnteriores = old('detalles', [[]]);
                @endphp

                @foreach ($partidasAnteriores as $indice => $detalle)

                    <div class="partida-pedido" style="border: 1px solid #ccc; padding: 15px; margin-bottom: 15px; border-radius: 8px;">

                        <h3>
                            Partida
                            <span class="numero-partida">{{ $loop->iteration }}</span>
                        </h3>

                        <div class="formulario-grid">

                            <div class="campo">
                                <label>Partida</label>

                                <input
                                    type="number"
                                    name="detalles[{{ $indice }}][partida]"
                                    value="{{ $detalle['partida'] ?? '' }}"
                                    min="1"
                                    data-required="true"
                                >
                            </div>

                            <div class="campo">
                                <label>Cantidad</label>

                                <input
                                    type="number"
                                    name="detalles[{{ $indice }}][cantidad]"
                                    value="{{ $detalle['cantidad'] ?? '' }}"
                                    min="1"
                                    data-required="true"
                                >
                            </div>

                            {{-- UNIDAD --}}
                            <div class="campo">
                                <label>Unidad</label>

                                <select
                                    name="detalles[{{ $indice }}][unidad_id]"
                                    class="unidad-select"
                                    data-required="true"
                                >
                                    <option value="">Selecciona una unidad</option>

                                    @foreach ($unidades as $unidad)
                                        <option
                                            value="{{ $unidad->id }}"
                                            data-nombre="{{ strtolower(trim($unidad->nombre)) }}"
                                            @selected(($detalle['unidad_id'] ?? '') == $unidad->id)
                                        >
                                            {{ $unidad->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- CAMPO OTRO --}}
                            <div
                                class="campo campo-unidad-otro"
                                style="display: none;"
                            >
                                <label>Otro</label>

                                <input
                                    type="text"
                                    name="detalles[{{ $indice }}][unidad_otro]"
                                    value="{{ $detalle['unidad_otro'] ?? '' }}"
                                    maxlength="100"
                                    placeholder="Especifica otra unidad"
                                    disabled
                                >
                            </div>

                            <div class="campo">
                                <label>Código</label>

                                <input
                                    type="text"
                                    name="detalles[{{ $indice }}][codigo]"
                                    value="{{ $detalle['codigo'] ?? '' }}"
                                    data-required="true"
                                >
                            </div>

                        </div>

                        <div class="campo">
                            <label>Descripción</label>

                            <input
                                type="text"
                                name="detalles[{{ $indice }}][descripcion]"
                                value="{{ $detalle['descripcion'] ?? '' }}"
                                maxlength="100"
                                data-required="true"
                            >
                        </div>

                        <div class="campo">
                            <label>Uso</label>

                            <textarea
                                name="detalles[{{ $indice }}][uso]"
                                rows="2"
                                data-required="true"
                            >{{ $detalle['uso'] ?? '' }}</textarea>
                        </div>

                        <div class="formulario-grid">

                            <div class="campo">
                                <label>Fecha de pago</label>

                                <input
                                    type="date"
                                    name="detalles[{{ $indice }}][fecha_pago]"
                                    value="{{ $detalle['fecha_pago'] ?? '' }}"
                                    data-required="true"
                                >
                            </div>

                            <div class="campo">
                                <label>¿Es a crédito?</label>

                                <select
                                    name="detalles[{{ $indice }}][credito]"
                                    data-required="true"
                                >
                                    <option value="">Selecciona una opción</option>

                                    <option
                                        value="1"
                                        @selected(($detalle['credito'] ?? '') == '1')
                                    >
                                        Sí
                                    </option>

                                    <option
                                        value="0"
                                        @selected(($detalle['credito'] ?? '') == '0')
                                    >
                                        No
                                    </option>
                                </select>
                            </div>

                        </div>

                        <button
                            type="button"
                            class="btn btn-secundario eliminar-partida"
                        >
                            Eliminar partida
                        </button>

                    </div>

                @endforeach

            </div>

            <button
                type="button"
                id="agregar-partida"
                class="btn btn-secundario"
            >
                Agregar otra partida
            </button>
        </section>

        {{-- BOTONES --}}
        <div class="formulario-acciones">

            <a href="{{ route('pedido.index') }}" class="btn btn-secundario">
                Cancelar
            </a>

            <button type="submit" class="btn btn-principal">
                Guardar pedido
            </button>

        </div>

    </form>

</main>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const tipoPedido = document.getElementById('tipo_pedido_id');
    const seccionInterno = document.getElementById('seccion-pedido-interno');
    const seccionAlm = document.getElementById('seccion-pedido-alm');

    const contenedor = document.getElementById('contenedor-partidas');
    const botonAgregar = document.getElementById('agregar-partida');


    // MOSTRAR U OCULTAR SECCIONES
    function configurarSeccion(seccion, mostrar) {

        seccion.style.display = mostrar ? 'block' : 'none';

        seccion.querySelectorAll('input, select, textarea').forEach(campo => {

            campo.disabled = !mostrar;

            if (campo.dataset.required === 'true') {
                campo.required = mostrar;
            }
        });

        // Mantener el comportamiento del campo Otro.
        if (mostrar && seccion.id === 'seccion-pedido-alm') {
            actualizarTodosLosCamposOtro();
        }
    }


    // MOSTRAR U OCULTAR EL CAMPO OTRO DE UNIDAD
    function actualizarCampoOtro(partida) {

        const selectUnidad = partida.querySelector('.unidad-select');
        const campoOtro = partida.querySelector('.campo-unidad-otro');

        if (!selectUnidad || !campoOtro) {
            return;
        }

        const inputOtro = campoOtro.querySelector('input');

        const opcion = selectUnidad.options[selectUnidad.selectedIndex];

        const nombreUnidad = opcion
            ? (opcion.dataset.nombre || '').trim().toLowerCase()
            : '';

        const esOtro = nombreUnidad === 'otro';

        campoOtro.style.display = esOtro ? 'block' : 'none';

        inputOtro.disabled = !esOtro;

        // El campo nunca será obligatorio.
        inputOtro.required = false;

        // Si se selecciona otra unidad, limpiar el texto.
        if (!esOtro) {
            inputOtro.value = '';
        }
    }


    // ACTUALIZAR TODOS LOS CAMPOS OTRO
    function actualizarTodosLosCamposOtro() {

        contenedor.querySelectorAll('.partida-pedido').forEach(partida => {
            actualizarCampoOtro(partida);
        });
    }


    // ACTUALIZAR TIPO DE PEDIDO
    function actualizarTipoPedido() {

        const tipoId = tipoPedido.value;

        // ID 1: Pedido general
        // ID 2: Pedido interno
        // ID 3: Pedido almacen

        configurarSeccion(
            seccionInterno,
            tipoId === '2'
        );

        configurarSeccion(
            seccionAlm,
            tipoId === '3'
        );

        actualizarTodosLosCamposOtro();
    }

    tipoPedido.addEventListener('change', actualizarTipoPedido);


    // CAMBIAR UNIDAD EN CUALQUIER PARTIDA
    contenedor.addEventListener('change', function (evento) {

        if (evento.target.classList.contains('unidad-select')) {

            const partida = evento.target.closest('.partida-pedido');

            actualizarCampoOtro(partida);
        }
    });


    // ACTUALIZAR NÚMEROS DE PARTIDAS
    function actualizarNumerosPartidas() {

        contenedor.querySelectorAll('.partida-pedido').forEach((partida, indice) => {
            partida.querySelector('.numero-partida').textContent = indice + 1;
        });
    }


    // AGREGAR PARTIDAS
    botonAgregar.addEventListener('click', function () {

        const indice = Date.now();

        const nuevaPartida = document.createElement('div');

        nuevaPartida.className = 'partida-pedido';

        nuevaPartida.style.cssText =
            'border: 1px solid #ccc; padding: 15px; margin-bottom: 15px; border-radius: 8px;';

        nuevaPartida.innerHTML = `
            <h3>
                Partida
                <span class="numero-partida"></span>
            </h3>

            <div class="formulario-grid">

                <div class="campo">
                    <label>Partida</label>

                    <input
                        type="number"
                        name="detalles[${indice}][partida]"
                        min="1"
                        data-required="true"
                    >
                </div>

                <div class="campo">
                    <label>Cantidad</label>

                    <input
                        type="number"
                        name="detalles[${indice}][cantidad]"
                        min="1"
                        data-required="true"
                    >
                </div>

                <div class="campo">
                    <label>Unidad</label>

                    <select
                        name="detalles[${indice}][unidad_id]"
                        class="unidad-select"
                        data-required="true"
                    >
                        <option value="">Selecciona una unidad</option>

                        @foreach ($unidades as $unidad)
                            <option
                                value="{{ $unidad->id }}"
                                data-nombre="{{ strtolower(trim($unidad->nombre)) }}"
                            >
                                {{ $unidad->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="campo campo-unidad-otro" style="display: none;">
                    <label>Otro</label>

                    <input
                        type="text"
                        name="detalles[${indice}][unidad_otro]"
                        maxlength="100"
                        placeholder="Especifica otra unidad"
                        disabled
                    >
                </div>

                <div class="campo">
                    <label>Código</label>

                    <input
                        type="text"
                        name="detalles[${indice}][codigo]"
                        data-required="true"
                    >
                </div>

            </div>

            <div class="campo">
                <label>Descripción</label>

                <input
                    type="text"
                    name="detalles[${indice}][descripcion]"
                    maxlength="100"
                    data-required="true"
                >
            </div>

            <div class="campo">
                <label>Uso</label>

                <textarea
                    name="detalles[${indice}][uso]"
                    rows="2"
                    data-required="true"
                ></textarea>
            </div>

            <div class="formulario-grid">

                <div class="campo">
                    <label>Fecha de pago</label>

                    <input
                        type="date"
                        name="detalles[${indice}][fecha_pago]"
                        data-required="true"
                    >
                </div>

                <div class="campo">
                    <label>¿Es a crédito?</label>

                    <select
                        name="detalles[${indice}][credito]"
                        data-required="true"
                    >
                        <option value="">Selecciona una opción</option>
                        <option value="1">Sí</option>
                        <option value="0">No</option>
                    </select>
                </div>

            </div>

            <button
                type="button"
                class="btn btn-secundario eliminar-partida"
            >
                Eliminar partida
            </button>
        `;

        contenedor.appendChild(nuevaPartida);

        actualizarNumerosPartidas();
        actualizarCampoOtro(nuevaPartida);
        actualizarTipoPedido();
    });


    // ELIMINAR PARTIDAS
    contenedor.addEventListener('click', function (evento) {

        if (evento.target.classList.contains('eliminar-partida')) {

            const partidas = contenedor.querySelectorAll('.partida-pedido');

            if (partidas.length > 1) {

                evento.target.closest('.partida-pedido').remove();

                actualizarNumerosPartidas();

            } else {

                alert('El pedido debe tener al menos una partida.');
            }
        }
    });


    // INICIALIZAR FORMULARIO
    actualizarNumerosPartidas();
    actualizarTipoPedido();
    actualizarTodosLosCamposOtro();

});
</script>

</body>
</html>