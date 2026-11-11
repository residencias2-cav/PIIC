<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Registrar pedido</title>

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
                Registrar pedido
            </h1>

            <p class="formulario-descripcion">
                Ingresa la información general del pedido.
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
        action="{{ route('pedido.store') }}"
        method="POST"
    >

        @csrf


        {{-- IDENTIFICACIÓN --}}

        <section class="formulario-seccion">

            <h2 class="formulario-seccion-titulo">
                Identificación
            </h2>


            <div class="formulario-grid">

                <div class="campo campo-bloqueado">

                    <label for="fecha_visual">
                        Fecha
                    </label>

                    <input
                        type="date"
                        id="fecha_visual"
                        value="{{ now()->toDateString() }}"
                        readonly
                    >

                </div>


                <div class="campo campo-bloqueado">

                    <label for="folio_visual">
                        Folio
                    </label>

                    <input
                        type="text"
                        id="folio_visual"
                        value="{{ $siguienteFolio }}"
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

                    <label for="tipo_pedido_id">
                        Tipo de pedido
                    </label>

                    <select
                        id="tipo_pedido_id"
                        name="tipo_pedido_id"
                        required
                    >

                        <option value="">
                            Selecciona un tipo de pedido
                        </option>

                        @foreach ($tiposPedido as $tipoPedido)

                            <option
                                value="{{ $tipoPedido->id }}"
                                @selected(
                                    old('tipo_pedido_id') == $tipoPedido->id
                                )
                            >
                                {{ $tipoPedido->nombre }}
                            </option>

                        @endforeach

                    </select>

                </div>


                <div class="campo">

                    <label for="tipo_compra_id">
                        Tipo de compra
                    </label>

                    <select
                        id="tipo_compra_id"
                        name="tipo_compra_id"
                        required
                    >

                        <option value="">
                            Selecciona un tipo de compra
                        </option>

                        @foreach ($tiposCompra as $tipoCompra)

                            <option
                                value="{{ $tipoCompra->id }}"
                                @selected(
                                    old('tipo_compra_id') == $tipoCompra->id
                                )
                            >
                                {{ $tipoCompra->nombre }}
                            </option>

                        @endforeach

                    </select>

                </div>

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

                    <option value="">
                        Selecciona un estado
                    </option>

                    @foreach ($estados as $estado)

                        <option
                            value="{{ $estado->id }}"
                            @selected(
                                old('estado_id') == $estado->id
                            )
                        >
                            {{ $estado->nombre_estado }}
                        </option>

                    @endforeach

                </select>

            </div>

        </section>


        {{-- ORIGEN --}}

        <section class="formulario-seccion">

            <h2 class="formulario-seccion-titulo">
                Origen
            </h2>


            <div class="formulario-grid">

                <div class="campo">

                    <label for="gerencia_id">
                        Gerencia
                    </label>

                    <select
                        id="gerencia_id"
                        name="gerencia_id"
                        required
                    >

                        <option value="">
                            Selecciona una gerencia
                        </option>

                        @foreach ($gerencias as $gerencia)

                            <option
                                value="{{ $gerencia->id }}"
                                @selected(
                                    old('gerencia_id') == $gerencia->id
                                )
                            >
                                {{ $gerencia->nombre }}
                            </option>

                        @endforeach

                    </select>

                </div>


                <div class="campo">

                    <label for="empresa_id">
                        Empresa
                    </label>

                    <select
                        id="empresa_id"
                        name="empresa_id"
                        required
                    >

                        <option value="">
                            Selecciona una empresa
                        </option>

                        @foreach ($empresas as $empresa)

                            <option
                                value="{{ $empresa->id }}"
                                @selected(
                                    old('empresa_id') == $empresa->id
                                )
                            >
                                {{ $empresa->nombre }}
                            </option>

                        @endforeach

                    </select>

                </div>

            </div>


            <div class="formulario-grid">

                <div class="campo">

                    <label for="proyecto_id">
                        Proyecto
                    </label>

                    <select
                        id="proyecto_id"
                        name="proyecto_id"
                        required
                    >

                        <option value="">
                            Selecciona un proyecto
                        </option>

                        @foreach ($proyectos as $proyecto)

                            <option
                                value="{{ $proyecto->id }}"
                                @selected(
                                    old('proyecto_id') == $proyecto->id
                                )
                            >
                                {{ $proyecto->nombre }}
                            </option>

                        @endforeach

                    </select>

                </div>


                <div class="campo">

                    <label for="ubicacion_id">
                        Ubicación
                    </label>

                    <select
                        id="ubicacion_id"
                        name="ubicacion_id"
                        required
                    >

                        <option value="">
                            Selecciona una ubicación
                        </option>

                        @foreach ($ubicaciones as $ubicacion)

                            <option
                                value="{{ $ubicacion->id }}"
                                @selected(
                                    old('ubicacion_id') == $ubicacion->id
                                )
                            >
                                {{ $ubicacion->nombre }}
                            </option>

                        @endforeach

                    </select>

                </div>

            </div>

        </section>


        {{-- INFORMACIÓN ECONÓMICA --}}

        <section class="formulario-seccion">

            <h2 class="formulario-seccion-titulo">
                Información económica
            </h2>


            <div class="formulario-grid">

                <div class="campo">

                    <label for="monto_credito">
                        Monto de crédito
                    </label>

                    <input
                        type="number"
                        id="monto_credito"
                        name="monto_credito"
                        value="{{ old('monto_credito') }}"
                        min="0"
                        step="1"
                        placeholder="0"
                    >

                </div>


                <div class="campo">

                    <label for="monto">
                        Monto
                    </label>

                    <input
                        type="number"
                        id="monto"
                        name="monto"
                        value="{{ old('monto') }}"
                        min="0"
                        step="0.01"
                        placeholder="0.00"
                        required
                    >

                </div>

            </div>

        </section>


        {{-- DETALLE --}}

        <section class="formulario-seccion">

            <h2 class="formulario-seccion-titulo">
                Detalle
            </h2>


            <div class="campo">

                <label for="observaciones">
                    Observaciones
                </label>

                <textarea
                    id="observaciones"
                    name="observaciones"
                    rows="4"
                    placeholder="Observaciones del pedido"
                >{{ old('observaciones') }}</textarea>

            </div>

        </section>


        {{-- AQUÍ VA DETALLEPEDIDO --}}
        {{--
            @includeIf('Compras.DetallePedido._form')
        --}}


        <div class="formulario-acciones">

            <a
                href="{{ route('pedido.index') }}"
                class="btn btn-secundario"
            >
                Cancelar
            </a>

            <button
                type="submit"
                class="btn btn-principal"
            >
                Guardar pedido
            </button>

        </div>

    </form>

</main>

</body>

</html>