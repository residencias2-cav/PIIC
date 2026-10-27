<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Obras</title>
</head>

<body>

    <h1>Catálogo de Obras</h1>

    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <a href="{{ route('obra.create') }}">
        Nueva obra
    </a>

    <br><br>

    <table border="1" cellpadding="8">

        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre de la obra</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>

            @forelse ($obras as $obra)

                <tr>
                    <td>{{ $obra->id }}</td>

                    <td>{{ $obra->nombre_obra }}</td>

                    <td>

                        <a href="{{ route('obra.edit', $obra) }}">
                            Editar
                        </a>

                        <form
                            action="{{ route('obra.destroy', $obra) }}"
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
                        No hay obras registradas.
                    </td>
                </tr>

            @endforelse

        </tbody>

    </table>

</body>
</html>