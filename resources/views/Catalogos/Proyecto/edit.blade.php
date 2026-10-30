<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Editar Proyecto</title>

    <link rel="stylesheet" href="{{ asset('css/catalogos.css') }}">
</head>

<body>

    <main class="formulario-card">

        {{-- Encabezado --}}
        <header class="formulario-header">

            <div class="catalogo-linea"></div>

            <div>
                <h1 class="formulario-titulo">
                    Editar Proyecto
                </h1>

                <p class="formulario-descripcion">
                    Modifica la información del proyecto seleccionado.
                </p>
            </div>

        </header>


        {{-- Formulario --}}
        <form
            action="{{ route('proyecto.update', $proyecto) }}"
            method="POST"
        >

            @csrf
            @method('PUT')


            {{-- Nombre --}}
            <div class="campo">

                <label for="nombre">
                    Nombre del proyecto
                </label>

                <input
                    type="text"
                    id="nombre"
                    name="nombre"
                    value="{{ old('nombre', $proyecto->nombre) }}"
                    maxlength="255"
                    required
                    autofocus
                >

                @error('nombre')
                    <p class="mensaje-error">
                        {{ $message }}
                    </p>
                @enderror

            </div>


            {{-- Botones --}}
            <div class="formulario-acciones">

                <a
                    href="{{ route('proyecto.index') }}"
                    class="btn btn-secundario"
                >
                    Cancelar
                </a>

                <button
                    type="submit"
                    class="btn btn-principal"
                >
                    Actualizar proyecto
                </button>

            </div>

        </form>

    </main>

</body>

</html>