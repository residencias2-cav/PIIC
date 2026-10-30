<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Nuevo contrato</title>

    <link rel="stylesheet" href="{{ asset('css/catalogos.css') }}">
</head>

<body>

    <main class="formulario-card">

        {{-- Encabezado --}}
        <header class="formulario-header">

            <div class="catalogo-linea"></div>

            <div>
                <h1 class="formulario-titulo">
                    Registrar Información de Contrato
                </h1>

                <p class="formulario-descripcion">
                    Ingresa la información del nuevo contrato.
                </p>
            </div>

        </header>


        {{-- Formulario --}}
        <form
            action="{{ route('inf_contrato.store') }}"
            method="POST"
        >

            @csrf


            {{-- Tipo de contrato --}}
            <div class="campo">

                <label for="tipo_contrato">
                    Tipo de contrato
                </label>

                <input
                    type="text"
                    id="tipo_contrato"
                    name="tipo_contrato"
                    value="{{ old('tipo_contrato') }}"
                    placeholder="Ejemplo: CompraVenta"
                    required
                    autofocus
                >

                @error('tipo_contrato')
                    <p class="mensaje-error">
                        {{ $message }}
                    </p>
                @enderror

            </div>


            {{-- Vigencia --}}
            <div class="campo">

                <label for="vigencia">
                    Vigencia
                </label>

                <input
                    type="date"
                    id="vigencia"
                    name="vigencia"
                    value="{{ old('vigencia') }}"
                    required
                >

                @error('vigencia')
                    <p class="mensaje-error">
                        {{ $message }}
                    </p>
                @enderror

            </div>


            {{-- Acciones --}}
            <div class="formulario-acciones">

                <a
                    href="{{ route('inf_contrato.index') }}"
                    class="btn btn-secundario"
                >
                    Cancelar
                </a>

                <button
                    type="submit"
                    class="btn btn-principal"
                >
                    Guardar contrato
                </button>

            </div>

        </form>

    </main>

</body>

</html>