<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar producto o servicio</title>
</head>

<body>

    <h1>Editar Producto o Servicio</h1>

    <form
        action="{{ route('producto_servicio.update', $productoServicio) }}"
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
                value="{{ old('nombre', $productoServicio->nombre) }}"
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

        <a href="{{ route('producto_servicio.index') }}">
            Cancelar
        </a>

    </form>

</body>
</html>