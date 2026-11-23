<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar folio de compra</title>
    <link rel="stylesheet" href="{{ asset('css/catalogos.css') }}">
</head>
<body>

<main class="formulario-card">

    <header class="formulario-header">
        <div class="catalogo-linea"></div>

        <h1 class="formulario-titulo">Editar folio de compra</h1>

        <p class="formulario-descripcion">
            Modifica la información del folio de compra seleccionado.
        </p>
    </header>

    @if($errors->any())
        <div class="mensaje-error">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('folio_compras.update', $folioCompra->id) }}"
          method="POST">

        @csrf
        @method('PUT')

        <section class="formulario-seccion">

            <h2 class="formulario-seccion-titulo">
                Información del folio de compra
            </h2>

            <div class="formulario-grid">

                <div class="campo">
                    <label for="pedido_id">Pedido</label>

                    <select name="pedido_id" id="pedido_id" required>
                        <option value="">Selecciona un pedido</option>

                        @foreach($pedidos as $pedido)
                            <option value="{{ $pedido->id }}"
                                {{ old('pedido_id', $folioCompra->pedido_id) == $pedido->id ? 'selected' : '' }}>
                                Pedido #{{ $pedido->id }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="campo">
                    <label for="fecha">Fecha</label>

                    <input
                        type="date"
                        name="fecha"
                        id="fecha"
                        value="{{ old('fecha', $folioCompra->fecha) }}"
                        required>
                </div>

                <div class="campo">
                    <label for="folio">Folio</label>

                    <input
                        type="text"
                        name="folio"
                        id="folio"
                        maxlength="20"
                        value="{{ old('folio', $folioCompra->folio) }}"
                        required>
                </div>

                <div class="campo">
                    <label for="notas_autorizacion">
                        Notas de autorización
                    </label>

                    <textarea
                        name="notas_autorizacion"
                        id="notas_autorizacion"
                        maxlength="100"
                        rows="3"
                        required>{{ old('notas_autorizacion', $folioCompra->notas_autorizacion) }}</textarea>
                </div>

                <div class="campo">
                    <label for="observaciones">Observaciones</label>

                    <textarea
                        name="observaciones"
                        id="observaciones"
                        maxlength="100"
                        rows="3"
                        required>{{ old('observaciones', $folioCompra->observaciones) }}</textarea>
                </div>

            </div>

        </section>

        <div class="formulario-acciones">

            <a href="{{ route('folio_compras.index') }}"
               class="btn btn-secundario">
                Cancelar
            </a>

            <button type="submit" class="btn btn-principal">
                Actualizar folio
            </button>

        </div>

    </form>

</main>

</body>
</html>