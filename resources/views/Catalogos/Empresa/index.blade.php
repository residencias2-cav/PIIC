<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Empresas</title>
</head>

<body>

    <h1>Catálogo de Empresas</h1>

    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <a href="{{ route('empresa.create') }}">
        Nueva empresa
    </a>

    <br><br>

    <table border="1" cellpadding="8">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>RFC</th>
                <th>Domicilio Fiscal</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($empresas as $empresa)
                <tr>
                    <td>{{ $empresa->id }}</td>
                    <td>{{ $empresa->nombre }}</td>
                    <td>{{ $empresa->rfc }}</td>
                    <td>{{ $empresa->dom_fiscal }}</td>

                    <td>
                        <a href="{{ route('empresa.edit', $empresa) }}">
                            Editar
                        </a>

                        <form
                            action="{{ route('empresa.destroy', $empresa) }}"
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
                    <td colspan="5">
                        No hay empresas registradas.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

</body>
</html>