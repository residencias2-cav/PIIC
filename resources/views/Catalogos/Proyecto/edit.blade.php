<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar proyecto</title>
</head>

<body>

    <h1>Editar Proyecto</h1>

    <form
        action="{{ route('proyecto.update', $proyecto) }}"
        method="POST"
    >

        @csrf
        @method('PUT')

        <div>
            <label for="nombre">
                Nombre:
            </label>

            <input
                type="text"
                id="nombre"
                name="nombre"
                value="{{ old('nombre', $proyecto->nombre) }}"
                required
            >

            @error('nombre')
                <p>{{ $message }}</p>
            @enderror
        </div>

        <br>

        <button type="submit">
            Actualizar
        </button>

        <a href="{{ route('proyecto.index') }}">
            Cancelar
        </a>

    </form>

</body>
</html>