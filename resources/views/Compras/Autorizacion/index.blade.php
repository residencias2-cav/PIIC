<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autorizaciones pendientes</title>
    <link rel="stylesheet" href="{{ asset('css/catalogos.css') }}">
</head>
<body>

<main class="catalogo-contenedor">

    <header class="catalogo-header">
        <div class="catalogo-header-info">
            <div class="catalogo-linea"></div>
            <div>
                <h1 class="catalogo-titulo">Autorizaciones pendientes</h1>
                <p class="catalogo-descripcion">
                    Pedidos que requieren revisión y autorización.
                </p>
            </div>
        </div>
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

        @if($autorizaciones->count() > 0)

            <div class="tabla-responsive">
                <table class="catalogo-tabla">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Usuario</th>
                            <th>Pedido</th>
                            <th>Proceso autorizado</th>
                            <th>Fecha de autorización</th>
                            <th>Observaciones</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($autorizaciones as $autorizacion)
                            <tr>
                                <td>{{ $autorizacion->id }}</td>

                                <td>
                                    @if($autorizacion->usuario?->trabajador)
                                        {{ $autorizacion->usuario->trabajador->nombre }}
                                        {{ $autorizacion->usuario->trabajador->apellido_paterno }}
                                        {{ $autorizacion->usuario->trabajador->apellido_materno }}
                                    @else
                                        {{ $autorizacion->usuario?->usuario ?? 'Sin usuario' }}
                                    @endif
                                </td>

                                <td>
                                    {{ $autorizacion->pedido?->folio ?? 'Sin pedido' }}
                                </td>

                                <td>Pendiente</td>

                                <td>{{ $autorizacion->fecha_autorizacion }}</td>

                                <td>{{ $autorizacion->observaciones }}</td>

                                <td>
                                    <div class="acciones">
                                        <a href="{{ route('autorizacion.edit', $autorizacion->id) }}"
                                           class="btn btn-editar">
                                            Revisar pedido
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{ $autorizaciones->links() }}

        @else

            <div class="estado-vacio">
                <h2 class="estado-vacio-titulo">
                    No hay autorizaciones pendientes
                </h2>

                <p class="estado-vacio-texto">
                    Actualmente no hay pedidos que requieran autorización.
                </p>
            </div>

        @endif

    </section>

</main>

</body>
</html>