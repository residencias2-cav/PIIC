<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Solicitudes EPP</title>

    <link rel="stylesheet" href="{{ asset('css/catalogos.css') }}">
</head>

<body>

    <main class="catalogo-contenedor">

        <header class="catalogo-header">

            <div class="catalogo-header-info">

                <div class="catalogo-linea"></div>

                <div>
                    <h1 class="catalogo-titulo">
                        Solicitudes de EPP
                    </h1>

                    <p class="catalogo-descripcion">
                        Consulta y administración de solicitudes de equipo de protección personal.
                    </p>
                </div>

            </div>

            <a
                href="{{ route('epp.create') }}"
                class="btn btn-principal"
            >
                Nueva solicitud
            </a>

        </header>


        @if (session('success'))

            <div class="mensaje-exito">
                {{ session('success') }}
            </div>

        @endif


        <section class="catalogo-card">

            <div class="tabla-responsive">

                <table class="catalogo-tabla">

                    <thead>

                        <tr>
                            <th>Folio</th>
                            <th>Fecha</th>
                            <th>Tipo EPP</th>
                            <th>Obra</th>
                            <th>Empresa</th>
                            <th>Motivo</th>
                            <th>Logística</th>
                            <th>Acciones</th>
                        </tr>

                    </thead>

                    <tbody>

                        @forelse ($epps as $epp)

                            <tr>

                                <td>
                                    {{ $epp->folio }}
                                </td>

                                <td>
                                    {{ $epp->fecha?->format('d/m/Y') }}
                                </td>

                                <td>
                                    {{ $epp->tipoEpp?->nombre ?? 'Sin tipo' }}
                                </td>

                                <td>
                                    {{ $epp->obra?->nombre_obra ?? 'Sin obra' }}
                                </td>

                                <td>
                                    {{ $epp->empresa?->nombre ?? 'Sin empresa' }}
                                </td>

                                <td>
                                    {{ $epp->motivo }}
                                </td>

                                <td>
                                    {{ $epp->logistica }}
                                </td>

                                <td>

                                    <div class="acciones">

                                        <a
                                            href="{{ route('epp.edit', $epp) }}"
                                            class="btn btn-editar"
                                        >
                                            Editar
                                        </a>

                                        <form
                                            action="{{ route('epp.destroy', $epp) }}"
                                            method="POST"
                                            onsubmit="return confirm('¿Deseas eliminar esta solicitud de EPP?');"
                                        >

                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="btn btn-eliminar"
                                            >
                                                Eliminar
                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td
                                    colspan="8"
                                    class="estado-vacio"
                                >

                                    <p class="estado-vacio-titulo">
                                        No hay solicitudes de EPP registradas
                                    </p>

                                    <p class="estado-vacio-texto">
                                        Registra una solicitud para comenzar.
                                    </p>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </section>

    </main>

</body>

</html>