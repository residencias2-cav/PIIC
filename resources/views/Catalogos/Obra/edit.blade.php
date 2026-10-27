<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar obra</title>
    <link rel="stylesheet" href="{{ asset('css/catalogos.css') }}">
</head>

<body>

    <h1>Editar Obra</h1>

    <form
        action="{{ route('obra.update', $obra) }}"
        method="POST"
    >

        @csrf
        @method('PUT')

        <div>

            <label for="nombre_obra">
                Nombre de la obra:
            </label>

            <input
                type="text"
                id="nombre_obra"
                name="nombre_obra"
                value="{{ old('nombre_obra', $obra->nombre_obra) }}"
                required
            >

            @error('nombre_obra')
                <p>{{ $message }}</p>
            @enderror

        </div>

        <br>

        <button type="submit">
            Actualizar
        </button>

        <a href="{{ route('obra.index') }}">
            Cancelar
        </a>

    </form>

</body>
</html>