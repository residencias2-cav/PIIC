<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar artículo</title>
</head>

<body>

    <h1>Editar artículo</h1>

    <form
        action="{{ route('articulo.update', $articulo) }}"
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
                value="{{ old('nombre', $articulo->nombre) }}"
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

        <a href="{{ route('articulo.index') }}">
            Cancelar
        </a>

    </form>

</body>

</html>