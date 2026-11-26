<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Datos de cotización</title>
    <link rel="stylesheet" href="{{ asset('css/catalogos.css') }}">
</head>
<body>

<main class="catalogo-contenedor">

    <header class="catalogo-header">
        <div class="catalogo-header-info">
            <div class="catalogo-linea"></div>
            <div>
                <h1 class="catalogo-titulo">Datos de cotización</h1>
                <p class="catalogo-descripcion">
                    Administración de los conceptos y productos asociados a las cotizaciones.
                </p>
            </div>
        </div>

        <a href="{{ route('datos_cotizacion.create') }}" class="btn btn-principal">
            Registrar dato
        </a>
    </header>

    @if(session('success'))
        <div class="mensaje-exito">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="mensaje-error">
            {{ session('error') }}
        </div>
    @endif

    <section class="catalogo-card">

        @if($datosCotizacion->count() > 0)

            <div class="tabla-responsive">
                <table class="catalogo-tabla">
                    <thead>
                        <tr>
                            <th>Cotización</th>
                            <th>Unidad</th>
                            <th>Descripción</th>
                            <th>Código</th>
                            <th>Entregado</th>
                            <th>Fecha de recepción</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($datosCotizacion as $dato)
                            <tr>
                                <td>{{ $dato->cotizacion->folio ?? 'Sin folio' }}</td>
                                <td>{{ $dato->unidad->nombre ?? 'Sin unidad' }}</td>
                                <td>{{ $dato->descripcion }}</td>
                                <td>{{ $dato->codigo }}</td>
                                <td>
                                    {{ $dato->entregado ? 'Sí' : 'No' }}
                                </td>
                                <td>{{ $dato->fecha_r }}</td>
                                <td>
                                    <div class="acciones">
                                        <a href="{{ route('datos_cotizacion.edit', $dato->id) }}"
                                           class="btn btn-editar">
                                            Editar
                                        </a>

                                        <form action="{{ route('datos_cotizacion.destroy', $dato->id) }}"
                                              method="POST"
                                              onsubmit="return confirm('¿Estás seguro de eliminar este registro?')">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn btn-eliminar">
                                                Eliminar
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{ $datosCotizacion->links() }}

        @else
            <div class="estado-vacio">
                <h2 class="estado-vacio-titulo">No hay datos registrados</h2>
                <p class="estado-vacio-texto">
                    Todavía no se han registrado conceptos o productos de cotización.
                </p>
            </div>
        @endif

    </section>

</main>

</body>
</html>