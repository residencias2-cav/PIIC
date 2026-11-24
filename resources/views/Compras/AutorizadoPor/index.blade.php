<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autorizaciones de EPP</title>
    <link rel="stylesheet" href="{{ asset('css/catalogos.css') }}">
</head>
<body>

<main class="catalogo-contenedor">

    <header class="catalogo-header">
        <div class="catalogo-header-info">
            <div class="catalogo-linea"></div>
            <div>
                <h1 class="catalogo-titulo">Autorizaciones de EPP</h1>
                <p class="catalogo-descripcion">
                    Consulta y administra las autorizaciones de EPP.
                </p>
            </div>
        </div>

        <a href="{{ route('autorizado_por.create') }}" class="btn btn-principal">
            Nueva autorización
        </a>
    </header>

    @if(session('success'))
        <div class="mensaje-exito">
            {{ session('success') }}
        </div>
    @endif

    <section class="catalogo-card">
        <div class="tabla-responsive">

            <table class="catalogo-tabla">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Trabajador</th>
                        <th>Folio EPP</th>
                        <th>Proceso autorizado</th>
                        <th>Fecha de autorización</th>
                        <th>Observaciones</th>
                        <th>Acciones</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($autorizadoPors as $autorizado)
                        <tr>
                            <td>{{ $autorizado->id }}</td>

                            <td>
                                @if($autorizado->trabajador)
                                    {{ $autorizado->trabajador->nombre }}
                                    {{ $autorizado->trabajador->apellido_paterno }}
                                    {{ $autorizado->trabajador->apellido_materno }}
                                @else
                                    Trabajador no disponible
                                @endif
                            </td>

                            <td>
                                {{ $autorizado->epp->folio ?? 'EPP no disponible' }}
                            </td>

                            <td>
                                {{ $autorizado->proceso_autorizado ? 'Sí' : 'No' }}
                            </td>

                            <td>{{ $autorizado->fecha_autorizacion }}</td>

                            <td>{{ $autorizado->observaciones }}</td>

                            <td>
                                <div class="acciones">

                                    <a href="{{ route('autorizado_por.edit', $autorizado->id) }}"
                                       class="btn btn-editar">
                                        Editar
                                    </a>

                                    <form action="{{ route('autorizado_por.destroy', $autorizado->id) }}"
                                          method="POST"
                                          onsubmit="return confirm('¿Estás segura de eliminar esta autorización?')">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn btn-eliminar">
                                            Eliminar
                                        </button>
                                    </form>

                                </div>
                            </td>
                        </tr>

                    @empty
                        <tr>
                            <td colspan="7" class="estado-vacio">
                                <p class="estado-vacio-titulo">
                                    No hay autorizaciones registradas.
                                </p>

                                <p class="estado-vacio-texto">
                                    Registra una nueva autorización para comenzar.
                                </p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

        </div>

        @if(method_exists($autorizadoPors, 'links'))
            {{ $autorizadoPors->links() }}
        @endif

    </section>

</main>

</body>
</html>