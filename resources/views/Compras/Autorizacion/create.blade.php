
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar autorización</title>
    <link rel="stylesheet" href="{{ asset('css/catalogos.css') }}">
</head>
<body>

<main class="formulario-card">

    <header class="formulario-header">
        <div class="catalogo-linea"></div>
        <div>
            <h1 class="formulario-titulo">Registrar autorización</h1>
            <p class="formulario-descripcion">
                Ingresa la información de la autorización del pedido.
            </p>
        </div>
    </header>

    <form action="{{ route('autorizacion.store') }}" method="POST">
        @csrf

        <section class="formulario-seccion">
            <h2 class="formulario-seccion-titulo">
                Información de la autorización
            </h2>

            <div class="formulario-grid">

                <div class="campo">
                    <label for="usuarios_id">Usuario</label>

                    <select name="usuarios_id" id="usuarios_id" required>
                        <option value="">Selecciona un usuario</option>

                        @foreach($usuarios as $usuario)
                            <option value="{{ $usuario->id }}"
                                {{ old('usuarios_id') == $usuario->id ? 'selected' : '' }}>

                                @if($usuario->trabajador)
                                    {{ $usuario->trabajador->nombre }}
                                    {{ $usuario->trabajador->apellido_paterno }}
                                    {{ $usuario->trabajador->apellido_materno }}
                                @else
                                    {{ $usuario->usuario }}
                                @endif

                            </option>
                        @endforeach
                    </select>

                    @error('usuarios_id')
                        <span class="mensaje-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="campo">
                    <label for="pedidos_id">Pedido</label>

                    <select name="pedidos_id" id="pedidos_id" required>
                        <option value="">Selecciona un pedido</option>

                        @foreach($pedidos as $pedido)
                            <option value="{{ $pedido->id }}"
                                {{ old('pedidos_id') == $pedido->id ? 'selected' : '' }}>
                                {{ $pedido->folio }}
                            </option>
                        @endforeach
                    </select>

                    @error('pedidos_id')
                        <span class="mensaje-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="campo">
                    <label for="proceso_autorizado">Proceso autorizado</label>

                    <select name="proceso_autorizado" id="proceso_autorizado" required>
                        <option value="">Selecciona una opción</option>

                        <option value="1"
                            {{ old('proceso_autorizado') === '1' ? 'selected' : '' }}>
                            Sí
                        </option>

                        <option value="0"
                            {{ old('proceso_autorizado') === '0' ? 'selected' : '' }}>
                            No
                        </option>
                    </select>

                    @error('proceso_autorizado')
                        <span class="mensaje-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="campo">
                    <label for="fecha_autorizacion">Fecha de autorización</label>

                    <input type="text"
                           name="fecha_autorizacion"
                           id="fecha_autorizacion"
                           maxlength="100"
                           value="{{ old('fecha_autorizacion') }}"
                           placeholder="Ingresa la fecha de autorización"
                           required>

                    @error('fecha_autorizacion')
                        <span class="mensaje-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="campo">
                    <label for="observaciones">Observaciones</label>

                    <textarea name="observaciones"
                              id="observaciones"
                              rows="4"
                              maxlength="150"
                              required>{{ old('observaciones') }}</textarea>

                    @error('observaciones')
                        <span class="mensaje-error">{{ $message }}</span>
                    @enderror
                </div>

            </div>
        </section>

        <div class="formulario-acciones">
            <a href="{{ route('autorizacion.index') }}" class="btn btn-secundario">
                Cancelar
            </a>

            <button type="submit" class="btn btn-principal">
                Guardar autorización
            </button>
        </div>

    </form>

</main>

</body>
</html>
