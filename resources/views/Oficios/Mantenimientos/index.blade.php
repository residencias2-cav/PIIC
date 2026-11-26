<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mantenimientos</title>
    <link rel="stylesheet" href="{{ asset('css/catalogos.css') }}">
</head>
<body>

<main class="catalogo-contenedor">

    <header class="catalogo-header">
        <div class="catalogo-header-info">
            <div class="catalogo-linea"></div>
            <div>
                <h1 class="catalogo-titulo">Mantenimientos</h1>
                <p class="catalogo-descripcion">
                    Administración de los mantenimientos registrados.
                </p>
            </div>
        </div>

        <a href="{{ route('mantenimientos.create') }}" class="btn btn-principal">
            Registrar mantenimiento
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

        @if($mantenimientos->count() > 0)

            <div class="tabla-responsive">
                <table class="catalogo-tabla">
                    <thead>
                        <tr>
                            <th>Folio</th>
                            <th>Fecha</th>
                            <th>Pedido</th>
                            <th>Trabajador</th>
                            <th>Gerencia</th>
                            <th>Lugar</th>
                            <th>Descripción</th>
                            <th>Autorizado por</th>
                            <th>Surtido</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($mantenimientos as $mantenimiento)
                            <tr>
                                <td>{{ $mantenimiento->folio }}</td>

                                <td>
                                    {{ $mantenimiento->fecha?->format('d/m/Y') }}
                                </td>

                                <td>
                                    {{ $mantenimiento->pedido?->folio ?? 'Sin pedido' }}
                                </td>

                                <td>
                                    @if($mantenimiento->trabajador)
                                        {{ $mantenimiento->trabajador->nombre }}
                                        {{ $mantenimiento->trabajador->apellido_paterno }}
                                        {{ $mantenimiento->trabajador->apellido_materno }}
                                    @else
                                        Sin trabajador
                                    @endif
                                </td>

                                <td>
                                    {{ $mantenimiento->gerencia?->code ?? 'Sin gerencia' }}
                                </td>

                                <td>{{ $mantenimiento->lugar }}</td>

                                <td>{{ $mantenimiento->descripcion }}</td>

                                <td>
                                    @if($mantenimiento->autorizadoPor)
                                        Autorización #{{ $mantenimiento->autorizadoPor->id }}
                                    @else
                                        Sin autorización
                                    @endif
                                </td>

                                <td>
                                    {{ $mantenimiento->surtido ? 'Sí' : 'No' }}
                                </td>

                                <td>
                                    <div class="acciones">

                                        <a href="{{ route('mantenimientos.edit', $mantenimiento->id) }}"
                                           class="btn btn-editar">
                                            Editar
                                        </a>

                                        <form action="{{ route('mantenimientos.destroy', $mantenimiento->id) }}"
                                              method="POST"
                                              onsubmit="return confirm('¿Estás seguro de eliminar este mantenimiento?')">
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

            {{ $mantenimientos->links() }}

        @else

            <div class="estado-vacio">
                <h2 class="estado-vacio-titulo">
                    No hay mantenimientos registrados
                </h2>

                <p class="estado-vacio-texto">
                    Todavía no se han registrado mantenimientos.
                </p>
            </div>

        @endif

    </section>

</main>

</body>
</html>