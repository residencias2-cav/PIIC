
@php
    $oficio = $oficios;

    $tipoSeleccionado = old('tipo_oficio_id', $oficio->tipo_oficio_id);
    $nombreTipo = $tiposOficio->firstWhere('id', $tipoSeleccionado)?->nombre
        ?? $oficio->tipoOficio?->nombre;

    $secciones = [
        'Oficios repse' => 'seccion-repse',
        'Oficios productos' => 'seccion-productos',
        'Oficios comisiones' => 'seccion-comisiones',
        'Oficios rutas' => 'seccion-rutas',
    ];
@endphp

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Editar oficio</title>

    <link rel="stylesheet" href="{{ asset('css/catalogos.css') }}">
</head>

<body>

<main class="formulario-card">

    <header class="formulario-header">
        <div class="catalogo-linea"></div>

        <div>
            <h1 class="formulario-titulo">Editar oficio</h1>

            <p class="formulario-descripcion">
                Modifica la información general y los datos del oficio.
            </p>
        </div>
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

    <form
        action="{{ route('oficios.update', $oficio) }}"
        method="POST"
    >
        @csrf
        @method('PUT')

        {{-- IDENTIFICACIÓN --}}
        <section class="formulario-seccion">

            <h2 class="formulario-seccion-titulo">
                Identificación
            </h2>

            <div class="formulario-grid">

                <div class="campo campo-bloqueado">
                    <label for="fecha">Fecha</label>

                    <input
                        type="date"
                        id="fecha"
                        value="{{ $oficio->fecha?->format('Y-m-d') }}"
                        readonly
                    >
                </div>

                <div class="campo campo-bloqueado">
                    <label for="folio">Folio</label>

                    <input
                        type="text"
                        id="folio"
                        value="{{ $oficio->folio }}"
                        readonly
                    >
                </div>

            </div>

        </section>

        {{-- CLASIFICACIÓN --}}
        <section class="formulario-seccion">

            <h2 class="formulario-seccion-titulo">
                Clasificación
            </h2>

            <div class="formulario-grid">

                <div class="campo">
                    <label for="tipo_oficio_id">
                        Tipo de oficio
                    </label>

                    <select
                        id="tipo_oficio_id"
                        name="tipo_oficio_id"
                        required
                    >
                        @foreach ($tiposOficio as $tipoOficio)
                            <option
                                value="{{ $tipoOficio->id }}"
                                @selected($tipoSeleccionado == $tipoOficio->id)
                            >
                                {{ $tipoOficio->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="campo">
                    <label for="estado_id">Estado</label>

                    <select
                        id="estado_id"
                        name="estado_id"
                        required
                    >
                        @foreach ($estados as $estado)
                            <option
                                value="{{ $estado->id }}"
                                @selected(
                                    old('estado_id', $oficio->estado_id) == $estado->id
                                )
                            >
                                {{ $estado->nombre_estado }}
                            </option>
                        @endforeach
                    </select>
                </div>

            </div>

        </section>

        {{-- CONTENIDO --}}
        <section class="formulario-seccion">

            <h2 class="formulario-seccion-titulo">
                Contenido
            </h2>

            <div class="campo">
                <label for="asunto">Asunto</label>

                <input
                    type="text"
                    id="asunto"
                    name="asunto"
                    value="{{ old('asunto', $oficio->asunto) }}"
                    required
                >
            </div>

            <div class="campo">
                <label for="cuerpo">Cuerpo del oficio</label>

                <textarea
                    id="cuerpo"
                    name="cuerpo"
                    rows="8"
                    required
                >{{ old('cuerpo', $oficio->cuerpo) }}</textarea>
            </div>

        </section>

        {{-- INFORMACIÓN ADICIONAL --}}
        <section class="formulario-seccion">

            <h2 class="formulario-seccion-titulo">
                Información adicional
            </h2>

            <div class="campo">
                <label for="observaciones">Observaciones</label>

                <textarea
                    id="observaciones"
                    name="observaciones"
                    rows="3"
                >{{ old('observaciones', $oficio->observaciones) }}</textarea>
            </div>

            <div class="campo">
                <label for="cargos_generales">Cargos generales</label>

                <textarea
                    id="cargos_generales"
                    name="cargos_generales"
                    rows="3"
                >{{ old('cargos_generales', $oficio->cargos_generales) }}</textarea>
            </div>

        </section>

        {{-- DETALLE REPSE --}}
        <section
            id="seccion-repse"
            class="formulario-seccion"
            style="display: none;"
        >
            <h2 class="formulario-seccion-titulo">
                Detalle REPSE
            </h2>

            @include('Oficios.OficiosRepse._form', [
                'contratos' => $contratos,
                'proveedores' => $proveedores,
                'empresas' => $empresas,
                'detalleRepse' => $oficio->oficiosRepSe->first(),
            ])
        </section>

        {{-- DETALLE PRODUCTOS --}}
        <section
            id="seccion-productos"
            class="formulario-seccion"
            style="display: none;"
        >
            <h2 class="formulario-seccion-titulo">
                Detalle Productos
            </h2>

            @include('Oficios.OficiosProductos._form', [
                'contratos' => $contratos,
                'proveedores' => $proveedores,
                'detalleProducto' => $oficio->oficiosProducto->first(),
            ])
        </section>

        {{-- DETALLE COMISIONES --}}
        <section
            id="seccion-comisiones"
            class="formulario-seccion"
            style="display: none;"
        >
            <h2 class="formulario-seccion-titulo">
                Detalle Comisiones
            </h2>

            @include('Oficios.OficiosComisiones._form', [
                'detalleComision' => $oficio->oficiosComisiones->first(),
            ])
        </section>

        {{-- DETALLE RUTAS --}}
        <section
            id="seccion-rutas"
            class="formulario-seccion"
            style="display: none;"
        >
            <h2 class="formulario-seccion-titulo">
                Detalle Rutas
            </h2>

            @include('Oficios.OficiosRutas._form', [
                'trabajadores' => $trabajadores,
                'detalleRuta' => $oficio->oficiosRutas->first(),
            ])
        </section>

        {{-- ACCIONES --}}
        <div class="formulario-acciones">

            <a
                href="{{ route('oficios.index') }}"
                class="btn btn-secundario"
            >
                Cancelar
            </a>

            <button
                type="submit"
                class="btn btn-principal"
            >
                Actualizar oficio
            </button>

        </div>

    </form>

</main>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const selectorTipo = document.getElementById('tipo_oficio_id');

    const secciones = {
        'Oficios repse': 'seccion-repse',
        'Oficios productos': 'seccion-productos',
        'Oficios comisiones': 'seccion-comisiones',
        'Oficios rutas': 'seccion-rutas'
    };

    function mostrarSeccion() {

        const tipoSeleccionado = selectorTipo.options[
            selectorTipo.selectedIndex
        ].text.trim();

        Object.entries(secciones).forEach(([tipo, idSeccion]) => {

            const seccion = document.getElementById(idSeccion);

            if (!seccion) return;

            const activa = tipo === tipoSeleccionado;

            seccion.style.display = activa ? 'block' : 'none';

            seccion.querySelectorAll('input, select, textarea').forEach(campo => {
                campo.disabled = !activa;
            });
        });
    }

    selectorTipo.addEventListener('change', mostrarSeccion);

    mostrarSeccion();

});
</script>

</body>
</html>