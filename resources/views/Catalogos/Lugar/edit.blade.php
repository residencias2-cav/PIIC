<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Editar lugar</title>

    <link rel="stylesheet" href="{{ asset('css/catalogos.css') }}">
</head>

<body>

    <main class="formulario-card">

        {{-- Encabezado --}}
        <header class="formulario-header">

            <div class="catalogo-linea"></div>

            <div>
                <h1 class="formulario-titulo">
                    Editar lugar
                </h1>

                <p class="formulario-descripcion">
                    Modifica la información del lugar seleccionado.
                </p>
            </div>

        </header>


        {{-- Formulario --}}
        <form
            action="{{ route('lugar.update', $lugar) }}"
            method="POST"
        >

            @csrf
            @method('PUT')


            {{-- Nombre --}}
            <div class="campo">

                <label for="nombre_municipio">
                    Nombre del lugar
                </label>

                <input
                    type="text"
                    id="nombre_municipio"
                    name="nombre_municipio"
                    value="{{ old('nombre_municipio', $lugar->nombre_municipio) }}"
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
                    href="{{ route('lugar.index') }}"
                    class="btn btn-secundario"
                >
                    Cancelar
                </a>

                <button
                    type="submit"
                    class="btn btn-principal"
                >
                    Actualizar lugar
                </button>

            </div>

        </form>

    </main>

</body>

</html>