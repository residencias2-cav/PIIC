<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar información bancaria</title>
    <link rel="stylesheet" href="{{ asset('css/catalogos.css') }}">
</head>

<body>

<main class="formulario-card">

    <header class="formulario-header">
        <div class="catalogo-linea"></div>
        <div>
            <h1 class="formulario-titulo">Registrar información bancaria</h1>
            <p class="formulario-descripcion">
                Registra los datos bancarios correspondientes a un proveedor.
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

    <form action="{{ route('informacion_bancaria.store') }}" method="POST">
        @csrf

        <section class="formulario-seccion">
            <h2 class="formulario-seccion-titulo">Datos bancarios</h2>

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
                    <label for="nombre_banco">Nombre del banco</label>
                    <input type="text"
                           name="nombre_banco"
                           id="nombre_banco"
                           maxlength="50"
                           value="{{ old('nombre_banco') }}"
                           required>
                </div>

                <div class="campo">
                    <label for="nombre_titular">Nombre del titular</label>
                    <input type="text"
                           name="nombre_titular"
                           id="nombre_titular"
                           maxlength="100"
                           value="{{ old('nombre_titular') }}"
                           required>
                </div>

                <div class="campo">
                    <label for="cuenta">Número de cuenta</label>
                    <input type="text"
                           name="cuenta"
                           id="cuenta"
                           maxlength="11"
                           minlength="11"
                           value="{{ old('cuenta') }}"
                           required>
                </div>

                <div class="campo">
                    <label for="clave">CLABE interbancaria</label>
                    <input type="text"
                           name="clave"
                           id="clave"
                           maxlength="18"
                           minlength="18"
                           value="{{ old('clave') }}"
                           required>
                </div>

            </div>
        </section>

        <div class="formulario-acciones">
            <a href="{{ route('informacion_bancaria.index') }}" class="btn btn-secundario">
                Cancelar
            </a>

            <button type="submit" class="btn btn-principal">
                Guardar información
            </button>
        </div>

    </form>

</main>

</body>
</html>