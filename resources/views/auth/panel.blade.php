<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Panel de Pedidos | Grupo CAVI</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            background: #f8fafc;
            color: #1e293b;
        }

        .app {
            min-height: 100vh;
            display: grid;
            grid-template-columns: 255px 1fr;
        }

        /* MENÚ */

        .sidebar {
            background: #ffffff;
            border-right: 1px solid #e2e8f0;
            padding: 24px 16px;
        }

        .marca {
            padding: 5px 12px 24px;
            border-bottom: 1px solid #e2e8f0;
            margin-bottom: 22px;
        }

        .marca strong {
            color: #991b1b;
            font-size: 17px;
        }

        .marca p {
            margin: 5px 0 0;
            font-size: 12px;
            color: #64748b;
        }

        .menu-titulo {
            margin: 24px 12px 10px;
            font-size: 11px;
            font-weight: 800;
            color: #94a3b8;
            letter-spacing: .12em;
        }

        .menu-opcion {
            display: block;
            width: 100%;
            padding: 10px 12px;
            margin-bottom: 3px;

            border: 0;
            border-radius: 8px;
            background: transparent;

            text-align: left;
            font-size: 14px;
            color: #475569;
            cursor: pointer;
        }

        .menu-opcion:hover,
        .menu-opcion.activo {
            background: #fef2f2;
            color: #991b1b;
        }

        .submenu {
            padding-left: 14px;
            margin-bottom: 12px;
        }

        .submenu .menu-opcion {
            font-size: 13px;
            padding: 8px 12px;
        }

        .accion {
            background: #991b1b;
            color: white;
            text-align: center;
            margin-top: 8px;
        }

        .accion:hover {
            background: #7f1d1d;
            color: white;
        }

        /* CONTENIDO */

        .contenido {
            padding: 28px 32px 40px;
        }

        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 28px;
        }

        .topbar h1 {
            margin: 0;
            font-size: 27px;
        }

        .topbar p {
            margin: 6px 0 0;
            color: #64748b;
            font-size: 14px;
        }

        .usuario {
            padding: 10px 16px;
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
        }

        .resumen {
            display: grid;
            grid-template-columns: repeat(4, minmax(150px, 1fr));
            gap: 16px;
            margin-bottom: 26px;
        }

        .tarjeta {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 14px;
            padding: 20px;
            box-shadow: 0 5px 15px rgba(15, 23, 42, .04);
        }

        .tarjeta .etiqueta {
            color: #64748b;
            font-size: 13px;
        }

        .tarjeta .numero {
            margin-top: 8px;
            font-size: 30px;
            font-weight: 800;
            color: #0f172a;
        }

        .tarjeta.roja {
            border-top: 3px solid #991b1b;
        }

        /* ÁREA DINÁMICA */

        .paneles {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(420px, 1fr));
            gap: 18px;
        }

        .panel {
            display: none;
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 14px;
            overflow: hidden;
        }

        .panel.visible {
            display: block;
        }

        .panel-header {
            padding: 18px 20px;
            border-bottom: 1px solid #e2e8f0;
        }

        .panel-header h2 {
            margin: 0;
            font-size: 18px;
        }

        .panel-header p {
            margin: 5px 0 0;
            color: #64748b;
            font-size: 13px;
        }

        .panel-body {
            padding: 20px;
        }

        .filtros {
            display: grid;
            grid-template-columns: 1fr 160px;
            gap: 10px;
            margin-bottom: 16px;
        }

        .filtros input,
        .filtros select {
            padding: 10px 12px;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            outline: none;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            text-align: left;
            padding: 11px 9px;
            border-bottom: 1px solid #f1f5f9;
            font-size: 13px;
        }

        th {
            color: #64748b;
            font-size: 11px;
            text-transform: uppercase;
        }

        .estado {
            display: inline-block;
            border-radius: 999px;
            padding: 5px 9px;
            font-size: 11px;
            font-weight: 700;
            background: #fef3c7;
            color: #92400e;
        }

        .actividad {
            margin-top: 26px;
        }

        .actividad h2 {
            font-size: 18px;
        }

        .actividad-item {
            display: grid;
            grid-template-columns: 140px 1fr 100px;
            padding: 13px 0;
            border-bottom: 1px solid #f1f5f9;
            font-size: 13px;
        }

        @media (max-width: 950px) {
            .app {
                grid-template-columns: 210px 1fr;
            }

            .resumen {
                grid-template-columns: repeat(2, 1fr);
            }

            .paneles {
                grid-template-columns: 1fr;
            }
        }
    </style>

</head>

<body>

<div class="app">

    <aside class="sidebar">

        <div class="marca">
            <strong>GRUPO CAVI</strong>
            <p>Sistema de Pedidos</p>
        </div>

        <button class="menu-opcion activo" data-panel="inicio">
            Inicio
        </button>

        <div class="menu-titulo">
            PEDIDOS
        </div>

        <button class="menu-opcion" data-panel="general">
            Pedido General
        </button>

        <div class="submenu">
            <button class="menu-opcion" data-panel="general">
                Actuales
            </button>

            <button class="menu-opcion" data-panel="historial-general">
                Historial
            </button>
        </div>


        <button class="menu-opcion" data-panel="alm">
            Pedido ALM
        </button>

        <div class="submenu">
            <button class="menu-opcion" data-panel="alm">
                Actuales
            </button>

            <button class="menu-opcion" data-panel="historial-alm">
                Historial
            </button>
        </div>


        <button class="menu-opcion" data-panel="int">
            Pedido INT
        </button>

        <div class="submenu">
            <button class="menu-opcion" data-panel="int">
                Actuales
            </button>

            <button class="menu-opcion" data-panel="historial-int">
                Historial
            </button>
        </div>


        <div class="menu-titulo">
            OFICIOS
        </div>

        <button class="menu-opcion" data-panel="oficios-recibidos">
            Recibidos
        </button>

        <button class="menu-opcion" data-panel="oficios-enviados">
            Enviados
        </button>

        <button class="menu-opcion" data-panel="historial-oficios">
            Historial
        </button>


        <div class="menu-titulo">
            ACCIONES
        </div>

        <button class="menu-opcion accion">
            + Nuevo pedido
        </button>

        <button class="menu-opcion accion">
            + Nuevo oficio
        </button>

    </aside>


    <main class="contenido">

        <header class="topbar">

            <div>
                <h1>Panel de trabajo</h1>

                <p>
                    Selecciona una o varias visualizaciones del menú.
                </p>
            </div>

            <div class="usuario">
                <strong>Usuario de prueba</strong><br>
                <small>Gerencia: GCHSO</small>
            </div>

        </header>


        {{-- =====================================================
             INICIO
             ===================================================== --}}

        <section id="inicio">

            <div class="resumen">

                <article class="tarjeta roja">
                    <span class="etiqueta">
                        Pedido General
                    </span>

                    <div class="numero">
                        12
                    </div>

                    <small>Pedidos activos</small>
                </article>


                <article class="tarjeta roja">
                    <span class="etiqueta">
                        Pedido ALM
                    </span>

                    <div class="numero">
                        7
                    </div>

                    <small>Pedidos activos</small>
                </article>


                <article class="tarjeta roja">
                    <span class="etiqueta">
                        Pedido INT
                    </span>

                    <div class="numero">
                        4
                    </div>

                    <small>Pedidos activos</small>
                </article>


                <article class="tarjeta roja">
                    <span class="etiqueta">
                        Oficios recibidos
                    </span>

                    <div class="numero">
                        3
                    </div>

                    <small>Pendientes</small>
                </article>

            </div>


            <section class="tarjeta actividad">

                <h2>
                    Actividad reciente
                </h2>

                <div class="actividad-item">
                    <strong>Pedido General</strong>
                    <span>PG-028</span>
                    <span class="estado">Pendiente</span>
                </div>

                <div class="actividad-item">
                    <strong>Pedido ALM</strong>
                    <span>ALM-015</span>
                    <span class="estado">Autorizado</span>
                </div>

                <div class="actividad-item">
                    <strong>Oficio</strong>
                    <span>OF-041</span>
                    <span class="estado">Recibido</span>
                </div>

            </section>

        </section>


        {{-- =====================================================
             PANELES SELECCIONABLES
             ===================================================== --}}

        <section class="paneles">

            <article class="panel" id="general">

                <header class="panel-header">
                    <h2>Pedido General</h2>
                    <p>Pedidos actuales de la gerencia.</p>
                </header>

                <div class="panel-body">

                    <div class="filtros">
                        <input
                            type="search"
                            placeholder="Buscar pedido..."
                        >

                        <select>
                            <option>Todos</option>
                            <option>Pendiente</option>
                            <option>Autorizado</option>
                        </select>
                    </div>

                    <table>
                        <thead>
                            <tr>
                                <th>Folio</th>
                                <th>Descripción</th>
                                <th>Estado</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <td>PG-028</td>
                                <td>Material para obra</td>
                                <td>
                                    <span class="estado">
                                        Pendiente
                                    </span>
                                </td>
                            </tr>

                            <tr>
                                <td>PG-027</td>
                                <td>Equipo de oficina</td>
                                <td>
                                    <span class="estado">
                                        Autorizado
                                    </span>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                </div>

            </article>


            <article class="panel" id="historial-general">

                <header class="panel-header">
                    <h2>Historial de Pedido General</h2>
                    <p>Pedidos finalizados o anteriores.</p>
                </header>

                <div class="panel-body">
                    Historial de ejemplo de Pedido General.
                </div>

            </article>


            <article class="panel" id="alm">

                <header class="panel-header">
                    <h2>Pedido ALM</h2>
                    <p>Pedidos de almacén disponibles.</p>
                </header>

                <div class="panel-body">
                    Contenido de Pedido ALM.
                </div>

            </article>


            <article class="panel" id="historial-alm">

                <header class="panel-header">
                    <h2>Historial Pedido ALM</h2>
                </header>

                <div class="panel-body">
                    Historial de ALM.
                </div>

            </article>


            <article class="panel" id="int">

                <header class="panel-header">
                    <h2>Pedido INT</h2>
                    <p>Pedidos internos.</p>
                </header>

                <div class="panel-body">
                    Contenido de Pedido INT.
                </div>

            </article>


            <article class="panel" id="historial-int">

                <header class="panel-header">
                    <h2>Historial Pedido INT</h2>
                </header>

                <div class="panel-body">
                    Historial de INT.
                </div>

            </article>


            <article class="panel" id="oficios-recibidos">

                <header class="panel-header">
                    <h2>Oficios recibidos</h2>
                </header>

                <div class="panel-body">
                    Oficios recibidos aparecerán aquí.
                </div>

            </article>


            <article class="panel" id="oficios-enviados">

                <header class="panel-header">
                    <h2>Oficios enviados</h2>
                </header>

                <div class="panel-body">
                    Oficios enviados aparecerán aquí.
                </div>

            </article>


            <article class="panel" id="historial-oficios">

                <header class="panel-header">
                    <h2>Historial de Oficios</h2>
                </header>

                <div class="panel-body">
                    Historial de oficios aparecerá aquí.
                </div>

            </article>

        </section>

    </main>

</div>


<script>

    const botones = document.querySelectorAll('[data-panel]');
    const panelInicio = document.getElementById('inicio');

    botones.forEach((boton) => {

        boton.addEventListener('click', () => {

            const panelId = boton.dataset.panel;

            /*
             * Inicio funciona distinto:
             * oculta todos los paneles y muestra
             * nuevamente el resumen.
             */
            if (panelId === 'inicio') {

                document
                    .querySelectorAll('.panel')
                    .forEach((panel) => {
                        panel.classList.remove('visible');
                    });

                panelInicio.style.display = 'block';

                return;
            }


            const panel = document.getElementById(panelId);

            if (!panel) {
                return;
            }


            /*
             * Al seleccionar cualquier visualización,
             * ocultamos el resumen inicial.
             */
            panelInicio.style.display = 'none';


            /*
             * Permite seleccionar varias visualizaciones
             * simultáneamente.
             */
            panel.classList.toggle('visible');

        });

    });

</script>

</body>

</html>