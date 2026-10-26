<h1>Gerencias</h1>

<a href="{{ route('gerencia.create') }}">
    Nueva gerencia
</a>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Código</th>
            <th>Acciones</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($gerencias as $gerencia)
            <tr>
                <td>{{ $gerencia->id }}</td>
                <td>{{ $gerencia->nombre }}</td>
                <td>{{ $gerencia->code }}</td>

                <td>
                    <a href="{{ route('gerencia.edit', $gerencia) }}">
                        Editar
                    </a>

                    <form
                        action="{{ route('gerencia.destroy', $gerencia) }}"
                        method="POST"
                    >
                        @csrf
                        @method('DELETE')

                        <button type="submit">
                            Eliminar
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>