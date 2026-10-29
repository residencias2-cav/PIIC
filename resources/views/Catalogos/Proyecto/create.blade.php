<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Nuevo Proyecto</title>

    <link rel="stylesheet" href="{{ asset('css/catalogos.css') }}">
</head>

<body>

    <main class="formulario-card">

        {{-- Encabezado --}}
        <header class="formulario-header">

            <div class="catalogo-linea"></div>

            <div>
                <h1 class="formulario-titulo">
                    Registrar Proyecto
                </h1>

                <p class="formulario-descripcion">
                    Ingresa la información del nuevo proyecto.
                </p>
            </div>

        </header>


        {{-- Formulario --}}
        <form
            action="{{ route('proyecto.store') }}"
            method="POST"
        >

            @csrf


            {{-- Nombre --}}
            <div class="campo">

                <label for="nombre">
                    Nombre del proyecto
                </label>

                <input
                    type="text"
                    id="nombre"
                    name="nombre"
                    value="{{ old('nombre') }}"
                    placeholder="Ejemplo: Saucito"
                    required
                    autofocus
                >

                @error('nombre')
                    <p class="mensaje-error">
                        {{ $message }}
                    </p>
                @enderror

            </div>


            {{-- Acciones --}}
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
                    Guardar proyecto
                </button>

            </div>

        </form>

    </main>

</body>

</html>