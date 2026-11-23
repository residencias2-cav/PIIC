<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nueva relación proveedor - producto o servicio</title>
    <link rel="stylesheet" href="{{ asset('css/catalogos.css') }}">
</head>
<body>

<main class="formulario-card">

    <header class="formulario-header">
        <div class="catalogo-linea"></div>

        <h1 class="formulario-titulo">Nueva relación proveedor - producto o servicio</h1>

        <p class="formulario-descripcion">
            Asocia un proveedor con un producto o servicio.
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

    <form action="{{ route('proveedor_servicios.store') }}" method="POST">
        @csrf

        <section class="formulario-seccion">

            <h2 class="formulario-seccion-titulo">
                Información de la relación
            </h2>

            <div class="formulario-grid">

                <div class="campo">
                    <label for="proveedor_id">Proveedor</label>

                    <select name="proveedor_id" id="proveedor_id" required>
                        <option value="">Selecciona un proveedor</option>

                        @foreach($proveedores as $proveedor)
                            <option value="{{ $proveedor->id }}"
                                {{ old('proveedor_id') == $proveedor->id ? 'selected' : '' }}>
                                {{ $proveedor->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="campo">
                    <label for="producto_servicio_id">Producto o servicio</label>

                    <select name="producto_servicio_id" id="producto_servicio_id" required>
                        <option value="">Selecciona un producto o servicio</option>

                        @foreach($productosServicios as $productoServicio)
                            <option value="{{ $productoServicio->id }}"
                                {{ old('producto_servicio_id') == $productoServicio->id ? 'selected' : '' }}>
                                {{ $productoServicio->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>

            </div>

        </section>

        <div class="formulario-acciones">

            <a href="{{ route('proveedor_servicios.index') }}"
               class="btn btn-secundario">
                Cancelar
            </a>

            <button type="submit" class="btn btn-principal">
                Guardar relación
            </button>

        </div>

    </form>

</main>

</body>
</html>