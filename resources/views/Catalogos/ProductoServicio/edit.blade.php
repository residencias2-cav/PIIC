<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Editar producto o servicio</title>

    <link rel="stylesheet" href="{{ asset('css/catalogos.css') }}">
</head>

<body>

    <main class="formulario-card">

        <header class="formulario-header">

            <div class="catalogo-linea"></div>

            <div>
                <h1 class="formulario-titulo">
                    Editar Producto o Servicio
                </h1>

                <p class="formulario-descripcion">
                    Modifica la información del producto o servicio seleccionado.
                </p>
            </div>

        </header>


        <form
            action="{{ route('producto_servicio.update', $productoServicio) }}"
            method="POST"
        >

            @csrf
            @method('PUT')


            <div class="campo">

                <label for="nombre">
                    Nombre
                </label>

                <input
                    type="text"
                    id="nombre"
                    name="nombre"
                    value="{{ old('nombre', $productoServicio->nombre) }}"
                    required
                    autofocus
                >

                @error('nombre')
                    <p class="mensaje-error">
                        {{ $message }}
                    </p>
                @enderror

            </div>


            <div class="formulario-acciones">

                <a
                    href="{{ route('producto_servicio.index') }}"
                    class="btn btn-secundario"
                >
                    Cancelar
                </a>

                <button
                    type="submit"
                    class="btn btn-principal"
                >
                    Actualizar producto o servicio
                </button>

            </div>

        </form>

    </main>

</body>

</html>