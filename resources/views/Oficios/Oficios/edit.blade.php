<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Editar oficio</title>

    <link
        rel="stylesheet"
        href="{{ asset('css/catalogos.css') }}"
    >
</head>

<body>

<main class="formulario-card">

    <header class="formulario-header">

        <div class="catalogo-linea"></div>

        <div>

            <h1 class="formulario-titulo">
                Editar oficio
            </h1>

            <p class="formulario-descripcion">
                Modifica la información general del oficio.
            </p>

        </div>

    </header>


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
        action="{{ route('oficio.update', $oficio) }}"
        method="POST"
    >

        @csrf
        @method('PUT')


        {{-- IDENTIFICACIÓN --}}

        <section class="formulario-seccion">

            <h2 class="formulario-seccion-titulo">
                Identificación
            </h2>


            <div class="formulario-grid">

                <div class="campo campo-bloqueado">

                    <label>
                        Fecha
                    </label>

                    <input
                        type="date"
                        value="{{ $oficio->fecha?->format('Y-m-d') }}"
                        readonly
                    >

                </div>


                <div class="campo campo-bloqueado">

                    <label>
                        Folio
                    </label>

                    <input
                        type="text"
                        value="{{ $oficio->folio }}"
                        readonly
                    >

                </div>

            </div>

        </section>


        {{-- CLASIFICACIÓN --}}

        <section class="formulario-seccion">

            <h2 class="formulario-seccion-titulo">
                Clasificación
            </h2>


            <div class="formulario-grid">

                <div class="campo">

                    <label for="tipo_oficio_id">
                        Tipo de oficio
                    </label>

                    <select
                        id="tipo_oficio_id"
                        name="tipo_oficio_id"
                        required
                    >

                        @foreach ($tiposOficio as $tipoOficio)

                            <option
                                value="{{ $tipoOficio->id }}"
                                @selected(
                                    old(
                                        'tipo_oficio_id',
                                        $oficio->tipo_oficio_id
                                    ) == $tipoOficio->id
                                )
                            >
                                {{ $tipoOficio->nombre }}
                            </option>

                        @endforeach

                    </select>

                </div>


                <div class="campo">

                    <label for="estado_id">
                        Estado
                    </label>

                    <select
                        id="estado_id"
                        name="estado_id"
                        required
                    >

                        @foreach ($estados as $estado)

                            <option
                                value="{{ $estado->id }}"
                                @selected(
                                    old(
                                        'estado_id',
                                        $oficio->estado_id
                                    ) == $estado->id
                                )
                            >
                                {{ $estado->nombre_estado }}
                            </option>

                        @endforeach

                    </select>

                </div>

            </div>

        </section>


        {{-- CONTENIDO --}}

        <section class="formulario-seccion">

            <h2 class="formulario-seccion-titulo">
                Contenido
            </h2>


            <div class="campo">

                <label for="asunto">
                    Asunto
                </label>

                <input
                    type="text"
                    id="asunto"
                    name="asunto"
                    value="{{ old(
                        'asunto',
                        $oficio->asunto
                    ) }}"
                    required
                >

            </div>


            <div class="campo">

                <label for="cuerpo">
                    Cuerpo del oficio
                </label>

                <textarea
                    id="cuerpo"
                    name="cuerpo"
                    rows="8"
                    required
                >{{ old(
                    'cuerpo',
                    $oficio->cuerpo
                ) }}</textarea>

            </div>

        </section>


        {{-- INFORMACIÓN ADICIONAL --}}

        <section class="formulario-seccion">

            <h2 class="formulario-seccion-titulo">
                Información adicional
            </h2>


            <div class="campo">

                <label for="observaciones">
                    Observaciones
                </label>

                <textarea
                    id="observaciones"
                    name="observaciones"
                    rows="3"
                >{{ old(
                    'observaciones',
                    $oficio->observaciones
                ) }}</textarea>

            </div>


            <div class="campo">

                <label for="cargos_generales">
                    Cargos generales
                </label>

                <textarea
                    id="cargos_generales"
                    name="cargos_generales"
                    rows="3"
                >{{ old(
                    'cargos_generales',
                    $oficio->cargos_generales
                ) }}</textarea>

            </div>

        </section>


        <div class="formulario-acciones">

            <a
                href="{{ route('oficio.index') }}"
                class="btn btn-secundario"
            >
                Cancelar
            </a>

            <button
                type="submit"
                class="btn btn-principal"
            >
                Actualizar oficio
            </button>

        </div>

    </form>

</main>

</body>

</html>