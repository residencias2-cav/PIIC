<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Editar Obra</title>

    <link rel="stylesheet" href="{{ asset('css/catalogos.css') }}">
</head>

<body>

    <main class="formulario-card">

        {{-- Encabezado --}}
        <header class="formulario-header">

            <div class="catalogo-linea"></div>

            <div>
                <h1 class="formulario-titulo">
                    Editar Obra
                </h1>

                <p class="formulario-descripcion">
                    Modifica la información de la obra seleccionada.
                </p>
            </div>

        </header>


        {{-- Formulario --}}
        <form
            action="{{ route('obra.update', $obra) }}"
            method="POST"
        >

            @csrf
            @method('PUT')


            {{-- Nombre --}}
            <div class="campo">

                <label for="nombre_obra">
                    Nombre de la obra
                </label>

                <input
                    type="text"
                    id="nombre_obra"
                    name="nombre_obra"
                    value="{{ old('nombre_obra', $obra->nombre_obra) }}"
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
                    href="{{ route('obra.index') }}"
                    class="btn btn-secundario"
                >
                    Cancelar
                </a>

                <button
                    type="submit"
                    class="btn btn-principal"
                >
                    Actualizar obra
                </button>

            </div>

        </form>

    </main>

</body>

</html>