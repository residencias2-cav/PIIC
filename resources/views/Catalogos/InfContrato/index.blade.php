<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Información de Contratos</title>
</head>

<body>

    <h1>Información de Contratos</h1>

    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <a href="{{ route('inf_contrato.create') }}">
        Nuevo contrato
    </a>

    <br><br>

    <table border="1" cellpadding="8">

        <thead>
            <tr>
                <th>ID</th>
                <th>Tipo de contrato</th>
                <th>Vigencia</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>

            @forelse ($infContratos as $infContrato)

                <tr>
                    <td>{{ $infContrato->id }}</td>

                    <td>{{ $infContrato->tipo_contrato }}</td>

                    <td>{{ $infContrato->vigencia }}</td>

                    <td>

                        <a href="{{ route('inf_contrato.edit', $infContrato) }}">
                            Editar
                        </a>

                        <form
                            action="{{ route('inf_contrato.destroy', $infContrato) }}"
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
                    <td colspan="4">
                        No hay contratos registrados.
                    </td>
                </tr>

            @endforelse

        </tbody>

    </table>

</body>
</html>