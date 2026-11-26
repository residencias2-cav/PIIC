<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Pedidos | Grupo CAVI</title>
    <link rel="stylesheet" href="{{ asset('css/panel.css') }}">
</head>
<body>

<div class="app">

    {{-- MENÚ LATERAL --}}
    <aside class="sidebar">

        <div class="marca">
            <strong>GRUPO CAVI</strong>
            <p>Sistema de Pedidos</p>
        </div>

        <button type="button" class="menu-opcion activo" data-panel="inicio">
            Inicio
        </button>

        <div class="menu-titulo">PEDIDOS</div>

        <button type="button" class="menu-opcion" data-panel="general">
            Pedido General
        </button>

        <div class="submenu">
            <button type="button" class="menu-opcion" data-panel="general">
                Actuales
            </button>
            <button type="button" class="menu-opcion" data-panel="historial-general">
                Historial
            </button>
        </div>

        <button type="button" class="menu-opcion" data-panel="alm">
            Pedido ALM
        </button>

        <div class="submenu">
            <button type="button" class="menu-opcion" data-panel="alm">
                Actuales
            </button>
            <button type="button" class="menu-opcion" data-panel="historial-alm">
                Historial
            </button>
        </div>

        <button type="button" class="menu-opcion" data-panel="int">
            Pedido INT
        </button>

        <div class="submenu">
            <button type="button" class="menu-opcion" data-panel="int">
                Actuales
            </button>
            <button type="button" class="menu-opcion" data-panel="historial-int">
                Historial
            </button>
        </div>

        <div class="menu-titulo">OFICIOS</div>

        <button type="button" class="menu-opcion" data-panel="oficios-recibidos">
            Recibidos
        </button>

        <button type="button" class="menu-opcion" data-panel="oficios-enviados">
            Enviados
        </button>

        <button type="button" class="menu-opcion" data-panel="historial-oficios">
            Historial
        </button>

    </aside>

    {{-- CONTENIDO PRINCIPAL --}}
    <main class="contenido">

        <header class="topbar">

            <div class="titulo-panel">
                <h1>Panel de trabajo</h1>
                <p>Consulta y administra la información del sistema.</p>
            </div>

            <div class="usuario">

                <div class="usuario-info">

                    <strong>
                        {{ $usuario->trabajador?->nombre ?? 'Usuario' }}
                        {{ $usuario->trabajador?->apellido_paterno ?? '' }}
                        {{ $usuario->trabajador?->apellido_materno ?? '' }}
                    </strong>

                    <small>
                        {{ $usuario->gerencia?->nombre ?? 'Sin gerencia' }}
                    </small>

                    <a href="{{ route('seguridad') }}" class="seguridad-btn">
                        Seguridad
                    </a>

                </div>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button type="submit" class="logout-btn">
                        Cerrar sesión
                    </button>
                </form>

            </div>

        </header>

        {{-- INICIO --}}
        <section id="inicio" class="inicio">

            {{-- ACCESOS RÁPIDOS DEL SUPERVISOR --}}
            @if($usuario->esSupervisor())

                <section class="tarjeta actividad">

                    <h2>Accesos rápidos</h2>

                    <p>
                        Desde aquí puedes registrar nuevos documentos y solicitudes.
                    </p>

                    <div class="acciones-rapidas">

                        <a href="{{ route('pedido.create') }}" class="menu-opcion">
                            Crear pedido
                        </a>

                        <a href="{{ route('epp.create') }}" class="menu-opcion">
                            Crear solicitud de EPP
                        </a>

                        <a href="{{ route('oficios.create') }}" class="menu-opcion">
                            Crear oficio
                        </a>

                    </div>

                    <p>
                        En el formulario de pedidos podrás seleccionar el tipo:
                        General, Interno o Almacén.
                    </p>

                </section>

            @endif

            {{-- RESUMEN DE PEDIDOS --}}
            <div class="resumen">

                <article class="tarjeta roja">
                    <span class="etiqueta">Pedido General</span>
                    <div class="numero">{{ $pedidosGeneral }}</div>
                    <small>Pedidos registrados</small>
                </article>

                <article class="tarjeta roja">
                    <span class="etiqueta">Pedido ALM</span>
                    <div class="numero">{{ $pedidosAlm }}</div>
                    <small>Pedidos registrados</small>
                </article>

                <article class="tarjeta roja">
                    <span class="etiqueta">Pedido INT</span>
                    <div class="numero">{{ $pedidosInt }}</div>
                    <small>Pedidos registrados</small>
                </article>

                <article class="tarjeta roja">
                    <span class="etiqueta">Total de pedidos</span>
                    <div class="numero">{{ $totalPedidos }}</div>
                    <small>Pedidos visibles</small>
                </article>

            </div>

            {{-- ACTIVIDAD RECIENTE --}}
            <section class="tarjeta actividad">

                <h2>Actividad reciente</h2>

                @forelse($actividadReciente as $pedido)

                    <div class="actividad-item">

                        <strong>
                            {{ $pedido->tipoPedido?->nombre ?? 'Pedido' }}
                        </strong>

                        <span>{{ $pedido->folio }}</span>

                        <span class="estado">
                            {{ $pedido->estado_solicitud?->value ?? 'Sin estado' }}
                        </span>

                    </div>

                @empty

                    <div class="estado-vacio">
                        No hay pedidos registrados.
                    </div>

                @endforelse

            </section>

            {{-- NOTIFICACIONES DE AUTORIZACIÓN --}}
            @if($usuario->esGerente())

                <section class="tarjeta actividad">

                    <h2>Autorizaciones pendientes</h2>

                    @forelse($autorizaciones as $autorizacion)

                        <div class="notificacion">

                            <div>
                                <strong>
                                    Pedido:
                                    {{ $autorizacion->pedido?->folio ?? 'Sin folio' }}
                                </strong>

                                <p>
                                    {{ $autorizacion->pedido?->tipoPedido?->nombre ?? 'Pedido' }}
                                    -
                                    {{ $autorizacion->pedido?->gerencia?->nombre ?? 'Sin gerencia' }}
                                </p>
                            </div>

                            <span class="estado">
                                Pendiente
                            </span>

                        </div>

                    @empty

                        <div class="estado-vacio">
                            No hay autorizaciones pendientes.
                        </div>

                    @endforelse

                </section>

            @endif

        </section>

        {{-- PANELES DE PEDIDOS --}}
        <section class="paneles">

            {{-- PEDIDO GENERAL --}}
            <article class="panel" id="general">

                <header class="panel-header">
                    <h2>Pedido General</h2>
                    <p>Pedidos generales registrados.</p>
                </header>

                <div class="panel-body">

                    <div class="filtros">
                        <input
                            type="search"
                            placeholder="Buscar pedido..."
                            data-busqueda="tabla-general"
                        >
                    </div>

                    <div class="tabla-responsive">
                        <table id="tabla-general">

                            <thead>
                                <tr>
                                    <th>Folio</th>
                                    <th>Fecha</th>
                                    <th>Gerencia</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse($pedidos->where('tipo_pedido_id', 1) as $pedido)

                                    <tr>
                                        <td>{{ $pedido->folio }}</td>

                                        <td>
                                            {{ $pedido->fecha?->format('d/m/Y') ?? 'Sin fecha' }}
                                        </td>

                                        <td>
                                            {{ $pedido->gerencia?->nombre ?? 'Sin gerencia' }}
                                        </td>

                                        <td>
                                            <span class="estado">
                                                {{ $pedido->estado_solicitud?->value ?? 'Sin estado' }}
                                            </span>
                                        </td>
                                    </tr>

                                @empty

                                    <tr>
                                        <td colspan="4" class="sin-registros">
                                            No hay pedidos generales.
                                        </td>
                                    </tr>

                                @endforelse
                            </tbody>

                        </table>
                    </div>

                </div>

            </article>

            {{-- HISTORIAL GENERAL --}}
            <article class="panel" id="historial-general">

                <header class="panel-header">
                    <h2>Historial de Pedido General</h2>
                    <p>Consulta de pedidos generales registrados.</p>
                </header>

                <div class="panel-body">

                    <div class="tabla-responsive">
                        <table>

                            <thead>
                                <tr>
                                    <th>Folio</th>
                                    <th>Fecha</th>
                                    <th>Gerencia</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse($pedidos->where('tipo_pedido_id', 1) as $pedido)

                                    <tr>
                                        <td>{{ $pedido->folio }}</td>
                                        <td>{{ $pedido->fecha?->format('d/m/Y') ?? 'Sin fecha' }}</td>
                                        <td>{{ $pedido->gerencia?->nombre ?? 'Sin gerencia' }}</td>
                                        <td>{{ $pedido->estado_solicitud?->value ?? 'Sin estado' }}</td>
                                    </tr>

                                @empty

                                    <tr>
                                        <td colspan="4" class="sin-registros">
                                            No hay pedidos generales registrados.
                                        </td>
                                    </tr>

                                @endforelse
                            </tbody>

                        </table>
                    </div>

                </div>

            </article>

            {{-- PEDIDO ALM --}}
            <article class="panel" id="alm">

                <header class="panel-header">
                    <h2>Pedido ALM</h2>
                    <p>Pedidos de almacén registrados.</p>
                </header>

                <div class="panel-body">

                    <div class="filtros">
                        <input
                            type="search"
                            placeholder="Buscar pedido..."
                            data-busqueda="tabla-alm"
                        >
                    </div>

                    <div class="tabla-responsive">
                        <table id="tabla-alm">

                            <thead>
                                <tr>
                                    <th>Folio</th>
                                    <th>Fecha</th>
                                    <th>Gerencia</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse($pedidos->where('tipo_pedido_id', 3) as $pedido)

                                    <tr>
                                        <td>{{ $pedido->folio }}</td>
                                        <td>{{ $pedido->fecha?->format('d/m/Y') ?? 'Sin fecha' }}</td>
                                        <td>{{ $pedido->gerencia?->nombre ?? 'Sin gerencia' }}</td>
                                        <td>{{ $pedido->estado_solicitud?->value ?? 'Sin estado' }}</td>
                                    </tr>

                                @empty

                                    <tr>
                                        <td colspan="4" class="sin-registros">
                                            No hay pedidos de almacén.
                                        </td>
                                    </tr>

                                @endforelse
                            </tbody>

                        </table>
                    </div>

                </div>

            </article>

            {{-- HISTORIAL ALM --}}
            <article class="panel" id="historial-alm">

                <header class="panel-header">
                    <h2>Historial Pedido ALM</h2>
                    <p>Consulta de pedidos de almacén registrados.</p>
                </header>

                <div class="panel-body">

                    <div class="tabla-responsive">
                        <table>

                            <thead>
                                <tr>
                                    <th>Folio</th>
                                    <th>Fecha</th>
                                    <th>Gerencia</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse($pedidos->where('tipo_pedido_id', 3) as $pedido)

                                    <tr>
                                        <td>{{ $pedido->folio }}</td>
                                        <td>{{ $pedido->fecha?->format('d/m/Y') ?? 'Sin fecha' }}</td>
                                        <td>{{ $pedido->gerencia?->nombre ?? 'Sin gerencia' }}</td>
                                        <td>{{ $pedido->estado_solicitud?->value ?? 'Sin estado' }}</td>
                                    </tr>

                                @empty

                                    <tr>
                                        <td colspan="4" class="sin-registros">
                                            No hay pedidos de almacén registrados.
                                        </td>
                                    </tr>

                                @endforelse
                            </tbody>

                        </table>
                    </div>

                </div>

            </article>

            {{-- PEDIDO INT --}}
            <article class="panel" id="int">

                <header class="panel-header">
                    <h2>Pedido INT</h2>
                    <p>Pedidos internos registrados.</p>
                </header>

                <div class="panel-body">

                    <div class="filtros">
                        <input
                            type="search"
                            placeholder="Buscar pedido..."
                            data-busqueda="tabla-int"
                        >
                    </div>

                    <div class="tabla-responsive">
                        <table id="tabla-int">

                            <thead>
                                <tr>
                                    <th>Folio</th>
                                    <th>Fecha</th>
                                    <th>Gerencia</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse($pedidos->where('tipo_pedido_id', 2) as $pedido)

                                    <tr>
                                        <td>{{ $pedido->folio }}</td>
                                        <td>{{ $pedido->fecha?->format('d/m/Y') ?? 'Sin fecha' }}</td>
                                        <td>{{ $pedido->gerencia?->nombre ?? 'Sin gerencia' }}</td>
                                        <td>{{ $pedido->estado_solicitud?->value ?? 'Sin estado' }}</td>
                                    </tr>

                                @empty

                                    <tr>
                                        <td colspan="4" class="sin-registros">
                                            No hay pedidos internos.
                                        </td>
                                    </tr>

                                @endforelse
                            </tbody>

                        </table>
                    </div>

                </div>

            </article>

            {{-- HISTORIAL INT --}}
            <article class="panel" id="historial-int">

                <header class="panel-header">
                    <h2>Historial Pedido INT</h2>
                    <p>Consulta de pedidos internos registrados.</p>
                </header>

                <div class="panel-body">

                    <div class="tabla-responsive">
                        <table>

                            <thead>
                                <tr>
                                    <th>Folio</th>
                                    <th>Fecha</th>
                                    <th>Gerencia</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse($pedidos->where('tipo_pedido_id', 2) as $pedido)

                                    <tr>
                                        <td>{{ $pedido->folio }}</td>
                                        <td>{{ $pedido->fecha?->format('d/m/Y') ?? 'Sin fecha' }}</td>
                                        <td>{{ $pedido->gerencia?->nombre ?? 'Sin gerencia' }}</td>
                                        <td>{{ $pedido->estado_solicitud?->value ?? 'Sin estado' }}</td>
                                    </tr>

                                @empty

                                    <tr>
                                        <td colspan="4" class="sin-registros">
                                            No hay pedidos internos registrados.
                                        </td>
                                    </tr>

                                @endforelse
                            </tbody>

                        </table>
                    </div>

                </div>

            </article>

            {{-- OFICIOS RECIBIDOS --}}
            <article class="panel" id="oficios-recibidos">

                <header class="panel-header">
                    <h2>Oficios recibidos</h2>
                    <p>Consulta de oficios recibidos.</p>
                </header>

                <div class="panel-body">
                    <div class="estado-vacio">
                        La información de oficios se conectará con su módulo correspondiente.
                    </div>
                </div>

            </article>

            {{-- OFICIOS ENVIADOS --}}
            <article class="panel" id="oficios-enviados">

                <header class="panel-header">
                    <h2>Oficios enviados</h2>
                    <p>Consulta de oficios enviados.</p>
                </header>

                <div class="panel-body">
                    <div class="estado-vacio">
                        La información de oficios se conectará con su módulo correspondiente.
                    </div>
                </div>

            </article>

            {{-- HISTORIAL DE OFICIOS --}}
            <article class="panel" id="historial-oficios">

                <header class="panel-header">
                    <h2>Historial de Oficios</h2>
                    <p>Consulta de oficios registrados.</p>
                </header>

                <div class="panel-body">
                    <div class="estado-vacio">
                        El historial se conectará con el módulo de oficios.
                    </div>
                </div>

            </article>

        </section>

    </main>

</div>

{{-- FUNCIONAMIENTO DEL MENÚ Y BÚSQUEDAS --}}
<script>
document.addEventListener('DOMContentLoaded', function () {

    const botones = document.querySelectorAll('[data-panel]');
    const inicio = document.getElementById('inicio');
    const paneles = document.querySelectorAll('.panel');

    function mostrarPanel(panelId) {

        inicio.style.display = panelId === 'inicio' ? 'block' : 'none';

        paneles.forEach(function (panel) {
            panel.classList.toggle('visible', panel.id === panelId);
        });

        botones.forEach(function (boton) {
            boton.classList.toggle('activo', boton.dataset.panel === panelId);
        });

    }

    botones.forEach(function (boton) {

        boton.addEventListener('click', function () {
            mostrarPanel(boton.dataset.panel);
        });

    });

    // Búsqueda de registros en las tablas
    document.querySelectorAll('[data-busqueda]').forEach(function (input) {

        input.addEventListener('input', function () {

            const tablaId = input.dataset.busqueda;
            const tabla = document.getElementById(tablaId);

            if (!tabla) {
                return;
            }

            const texto = input.value.toLowerCase().trim();

            tabla.querySelectorAll('tbody tr').forEach(function (fila) {

                fila.style.display = fila.textContent.toLowerCase().includes(texto)
                    ? ''
                    : 'none';

            });

        });

    });

    // Mostrar Inicio al entrar al panel
    mostrarPanel('inicio');

});
</script>

</body>
</html>