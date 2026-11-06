<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Editar Inventario EPP</title>

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
                    Editar Inventario EPP
                </h1>

                <p class="formulario-descripcion">
                    Modifica la talla o existencia registrada.
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
            action="{{ route(
                'inventario_epp.update',
                $inventario
            ) }}"
            method="POST"
        >

            @csrf
            @method('PUT')


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
                                old(
                                    'articulo_id',
                                    $inventario->articulo_id
                                ) == $articulo->id
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
                        value="{{ old(
                            'talla',
                            $inventario->talla
                        ) }}"
                        min="0"
                        step="1"
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
                        value="{{ old(
                            'existencia',
                            $inventario->existencia
                        ) }}"
                        min="0"
                        step="1"
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
                    Actualizar
                </button>

            </div>

        </form>

    </main>

</body>

</html>