<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Editar crédito</title>

    <link rel="stylesheet" href="{{ asset('css/catalogos.css') }}">
</head>

<body>

    <main class="formulario-card">

        {{-- Encabezado --}}
        <header class="formulario-header">

            <div class="catalogo-linea"></div>

            <div>
                <h1 class="formulario-titulo">
                    Editar Información de Crédito
                </h1>

                <p class="formulario-descripcion">
                    Modifica el monto y la vigencia del crédito seleccionado.
                </p>
            </div>

        </header>


        {{-- Formulario --}}
        <form
            action="{{ route('inf_credito.update', $infCredito) }}"
            method="POST"
        >

            @csrf
            @method('PUT')


            {{-- Monto --}}
            <div class="campo">

                <label for="monto">
                    Monto
                </label>

                <input
                    type="number"
                    id="monto"
                    name="monto"
                    value="{{ old('monto', $infCredito->monto) }}"
                    step="0.001"
                    min="0"
                    required
                    autofocus
                >

                @error('monto')
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
                    value="{{ old('vigencia', $infCredito->vigencia) }}"
                    required
                >

                @error('vigencia')
                    <p class="mensaje-error">
                        {{ $message }}
                    </p>
                @enderror

            </div>


            {{-- Botones --}}
            <div class="formulario-acciones">

                <a
                    href="{{ route('inf_credito.index') }}"
                    class="btn btn-secundario"
                >
                    Cancelar
                </a>

                <button
                    type="submit"
                    class="btn btn-principal"
                >
                    Actualizar crédito
                </button>

            </div>

        </form>

    </main>

</body>

</html>