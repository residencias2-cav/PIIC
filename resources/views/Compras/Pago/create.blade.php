<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar pago</title>
    <link rel="stylesheet" href="{{ asset('css/catalogos.css') }}">
</head>

<body>

<main class="formulario-card">

    <header class="formulario-header">
        <div class="catalogo-linea"></div>
        <div>
            <h1 class="formulario-titulo">Registrar pago</h1>
            <p class="formulario-descripcion">
                Registra la información del pago de un proveedor.
            </p>
        </div>
    </header>

    @if ($errors->any())
        <div class="mensaje-error">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('pago.store') }}" method="POST">
        @csrf

        <section class="formulario-seccion">
            <h2 class="formulario-seccion-titulo">Información del pago</h2>

            <div class="formulario-grid">

                <div class="campo">
                    <label for="proveedor_id">Proveedor</label>
                    <select name="proveedor_id" id="proveedor_id" required>
                        <option value="">Selecciona un proveedor</option>
                        @foreach ($proveedores as $proveedor)
                            <option value="{{ $proveedor->id }}"
                                {{ old('proveedor_id') == $proveedor->id ? 'selected' : '' }}>
                                {{ $proveedor->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="campo">
                    <label for="precio">Precio</label>
                    <input type="number" name="precio" id="precio"
                        step="0.01" min="0" value="{{ old('precio') }}" required>
                </div>

                <div class="campo">
                    <label for="iva">IVA</label>
                    <input type="number" name="iva" id="iva"
                        step="0.01" min="0" value="{{ old('iva') }}" required>
                </div>

                <div class="campo">
                    <label for="total">Total</label>
                    <input type="number" name="total" id="total"
                        step="0.01" min="0" value="{{ old('total') }}" required>
                </div>

                <div class="campo">
                    <label for="descuento">Descuento</label>
                    <input type="number" name="descuento" id="descuento"
                        step="0.01" min="0" value="{{ old('descuento') }}" required>
                </div>

                <div class="campo">
                    <label for="factura">Factura</label>
                    <input type="number" name="factura" id="factura"
                        step="0.01" min="0" value="{{ old('factura') }}" required>
                </div>

                <div class="campo">
                    <label for="comision">Comisión</label>
                    <input type="number" name="comision" id="comision"
                        step="0.01" min="0" value="{{ old('comision') }}" required>
                </div>

            </div>
        </section>

        <div class="formulario-acciones">
            <a href="{{ route('pago.index') }}" class="btn btn-secundario">
                Cancelar
            </a>
            <button type="submit" class="btn btn-principal">
                Guardar pago
            </button>
        </div>

    </form>

</main>

</body>
</html>