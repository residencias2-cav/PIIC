<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proyectos</title>
</head>

<body>

    <h1>Catálogo de Proyectos</h1>

    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <a href="{{ route('proyecto.create') }}">
        Nuevo proyecto
    </a>

    <br><br>

    <table border="1" cellpadding="8">

        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>

            @forelse ($proyectos as $proyecto)

                <tr>
                    <td>{{ $proyecto->id }}</td>

                    <td>{{ $proyecto->nombre }}</td>

                    <td>
                        <a href="{{ route('proyecto.edit', $proyecto) }}">
                            Editar
                        </a>

                        <form
                            action="{{ route('proyecto.destroy', $proyecto) }}"
                            method="POST"
                            style="display:inline"
                        >
                            @csrf
                            @method('DELETE')

                            <button type="submit">
                                Eliminar
                            </button>
                        </form>
                    </td>
                </tr>

            @empty

                <tr>
                    <td colspan="3">
                        No hay proyectos registrados.
                    </td>
                </tr>

            @endforelse

        </tbody>

    </table>

</body>
</html>