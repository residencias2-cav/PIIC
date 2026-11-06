<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Registrar Inventario EPP</title>

    <link
        rel="stylesheet"
        href="{{ asset('css/catalogos.css') }}"
    >
</head>

<body>

    <main class="formulario-card">

        {{-- Encabezado --}}
        <header class="formulario-header">

            <div class="catalogo-linea"></div>

            <div>

                <h1 class="formulario-titulo">
                    Registrar Inventario EPP
                </h1>

                <p class="formulario-descripcion">
                    Ingresa el artículo, talla y existencia disponible.
                </p>

            </div>

        </header>


        {{-- Errores --}}
        @if ($errors->any())

            <div class="mensaje-error">

                <strong>
                    Revisa la información:
                </strong>

                <ul>

                    @foreach ($errors->all() as $error)

                        <li>
                            {{ $error }}
                        </li>

                    @endforeach

                </ul>

            </div>

        @endif


        <form
            action="{{ route('inventario_epp.store') }}"
            method="POST"
        >

            @csrf


            {{-- Artículo --}}
            <div class="campo">

                <label for="articulo_id">
                    Artículo
                </label>

                <select
                    id="articulo_id"
                    name="articulo_id"
                    required
                >

                    <option value="">
                        Selecciona un artículo
                    </option>

                    @foreach ($articulos as $articulo)

                        <option
                            value="{{ $articulo->id }}"
                            @selected(
                                old('articulo_id') == $articulo->id
                            )
                        >
                            {{ $articulo->nombre }}
                        </option>

                    @endforeach

                </select>

                @error('articulo_id')
                    <p class="mensaje-error">
                        {{ $message }}
                    </p>
                @enderror

            </div>


            <div class="formulario-grid">

                {{-- Talla --}}
                <div class="campo">

                    <label for="talla">
                        Talla
                    </label>

                    <input
                        type="number"
                        id="talla"
                        name="talla"
                        value="{{ old('talla') }}"
                        min="0"
                        step="1"
                        placeholder="Ejemplo: 27"
                        required
                    >

                    @error('talla')
                        <p class="mensaje-error">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                {{-- Existencia --}}
                <div class="campo">

                    <label for="existencia">
                        Existencia
                    </label>

                    <input
                        type="number"
                        id="existencia"
                        name="existencia"
                        value="{{ old('existencia') }}"
                        min="0"
                        step="1"
                        placeholder="Ejemplo: 20"
                        required
                    >

                    @error('existencia')
                        <p class="mensaje-error">
                            {{ $message }}
                        </p>
                    @enderror

                </div>

            </div>


            {{-- Acciones --}}
            <div class="formulario-acciones">

                <a
                    href="{{ route('inventario_epp.index') }}"
                    class="btn btn-secundario"
                >
                    Cancelar
                </a>

                <button
                    type="submit"
                    class="btn btn-principal"
                >
                    Guardar
                </button>

            </div>

        </form>

    </main>

</body>

</html>