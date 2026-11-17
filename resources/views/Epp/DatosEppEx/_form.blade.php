
<section
    id="seccion-epp-ex"
    class="formulario-seccion detalle-epp"
    style="display: none;"
>
    <h2 class="formulario-seccion-titulo">
        Detalle EPP EX
    </h2>

    <div class="formulario-grid">

        <div class="campo">
            <label for="ex_trabajador_id">Trabajador</label>
            <select id="ex_trabajador_id">
                <option value="">Selecciona un trabajador</option>
                @foreach ($trabajadores as $trabajador)
                    <option value="{{ $trabajador->id }}">
                        {{ $trabajador->nombre }}
                        {{ $trabajador->apellido_paterno }}
                        {{ $trabajador->apellido_materno }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="campo">
            <label for="ex_cantidad">Cantidad</label>
            <input type="number" id="ex_cantidad" min="1">
        </div>

        <div class="campo">
            <label for="ex_equipo">Equipo</label>
            <input type="text" id="ex_equipo" maxlength="50">
        </div>

        <div class="campo">
            <label for="ex_codigo">Código</label>
            <input type="text" id="ex_codigo" maxlength="50">
        </div>

        <div class="campo">
            <label for="ex_marca">Marca</label>
            <input type="text" id="ex_marca" maxlength="50">
        </div>

        <div class="campo">
            <label for="ex_contrato">¿Cuenta con contrato?</label>
            <select id="ex_contrato">
                <option value="">Selecciona</option>
                <option value="1">Sí</option>
                <option value="0">No</option>
            </select>
        </div>

        <div class="campo">
            <label for="ex_observaciones">Observaciones</label>
            <input type="text" id="ex_observaciones" maxlength="100">
        </div>

        <div class="campo">
            <label for="ex_precio">Precio</label>
            <input type="number" id="ex_precio" min="0" step="0.01">
        </div>

        <div class="campo">
            <label for="ex_adjuntos">Adjunto (PDF)</label>
            <input
                type="file"
                id="ex_adjuntos"
                accept=".pdf,application/pdf"
            >
        </div>

        <div class="campo">
            <label for="ex_estado_id">Estado</label>
            <select id="ex_estado_id">
                <option value="">Selecciona un estado</option>

                @forelse ($estados as $estado)
                    <option value="{{ $estado->id }}">
                        {{ $estado->nombre_estado}}
                    </option>
                @empty
                    <option value="" disabled>
                        No hay estados registrados
                    </option>
                @endforelse
            </select>
        </div>

        <div class="campo">
            <label for="ex_fecha_estado">Fecha de estado</label>
            <input type="date" id="ex_fecha_estado">
        </div>

    </div>

    <button type="button" id="agregar-ex" class="btn btn-principal">
        Agregar elemento
    </button>

    <div class="tabla-contenedor tabla-ex-contenedor">
        <table class="tabla-ex-resumen">
            <thead>
                <tr>
                    <th>Trabajador</th>
                    <th>Cantidad</th>
                    <th>Equipo</th>
                    <th>Código</th>
                    <th>Marca</th>
                    <th>Contrato</th>
                    <th>Observaciones</th>
                    <th>Precio</th>
                    <th>PDF</th>
                    <th>Estado</th>
                    <th>Fecha estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody id="tabla-ex"></tbody>
        </table>
    </div>

    <div id="inputs-ex"></div>
</section>

<style>
    .tabla-ex-contenedor {
        width: 100%;
        max-width: 100%;
        overflow-x: auto;
        margin-top: 15px;
    }

    .tabla-ex-resumen {
        width: 100%;
        border-collapse: collapse;
        table-layout: auto;
        font-size: 11px;
    }

    .tabla-ex-resumen th,
    .tabla-ex-resumen td {
        padding: 6px 5px;
        font-size: 11px;
        text-align: center;
        vertical-align: middle;
        white-space: normal;
        overflow-wrap: anywhere;
    }

    .tabla-ex-resumen th {
        font-weight: 600;
    }

    .tabla-ex-resumen th:last-child,
    .tabla-ex-resumen td:last-child {
        min-width: 65px;
        white-space: nowrap;
    }

    .tabla-ex-resumen .btn-eliminar-ex {
        font-size: 10px;
        padding: 4px 6px;
        white-space: nowrap;
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const trabajador = document.getElementById('ex_trabajador_id');
    const cantidad = document.getElementById('ex_cantidad');
    const equipo = document.getElementById('ex_equipo');
    const codigo = document.getElementById('ex_codigo');
    const marca = document.getElementById('ex_marca');
    const contrato = document.getElementById('ex_contrato');
    const observaciones = document.getElementById('ex_observaciones');
    const precio = document.getElementById('ex_precio');
    const adjuntos = document.getElementById('ex_adjuntos');
    const estado = document.getElementById('ex_estado_id');
    const fechaEstado = document.getElementById('ex_fecha_estado');

    const boton = document.getElementById('agregar-ex');
    const tabla = document.getElementById('tabla-ex');
    const inputs = document.getElementById('inputs-ex');

    let indice = 0;

    boton.addEventListener('click', function () {

        const campos = [
            trabajador.value,
            cantidad.value,
            equipo.value.trim(),
            codigo.value.trim(),
            marca.value.trim(),
            contrato.value,
            observaciones.value.trim(),
            precio.value,
            estado.value,
            fechaEstado.value
        ];

        if (campos.some(valor => valor === '')) {
            alert('Completa todos los campos de EPP EX.');
            return;
        }

        if (Number(cantidad.value) < 1 || Number(precio.value) < 0) {
            alert('Verifica la cantidad y el precio.');
            return;
        }

        const archivo = adjuntos.files[0];

        if (!archivo) {
            alert('Selecciona un archivo PDF.');
            return;
        }

        if (
            archivo.type !== 'application/pdf' &&
            !archivo.name.toLowerCase().endsWith('.pdf')
        ) {
            alert('El archivo debe ser PDF.');
            return;
        }

        const trabajadorTexto =
            trabajador.options[trabajador.selectedIndex].text.trim();

        const estadoTexto =
            estado.options[estado.selectedIndex].text.trim();

        const contratoTexto = contrato.value === '1' ? 'Sí' : 'No';

        // Crear fila del resumen
        const fila = document.createElement('tr');

        const valores = [
            trabajadorTexto,
            cantidad.value,
            equipo.value.trim(),
            codigo.value.trim(),
            marca.value.trim(),
            contratoTexto,
            observaciones.value.trim(),
            '$' + Number(precio.value).toFixed(2),
            archivo.name,
            estadoTexto,
            fechaEstado.value
        ];

        valores.forEach(valor => {
            const celda = document.createElement('td');
            celda.textContent = valor;
            fila.appendChild(celda);
        });

        // Crear botón para eliminar
        const celdaAcciones = document.createElement('td');
        const botonEliminar = document.createElement('button');

        botonEliminar.type = 'button';
        botonEliminar.className = 'btn-eliminar-ex';
        botonEliminar.textContent = 'Eliminar';

        celdaAcciones.appendChild(botonEliminar);
        fila.appendChild(celdaAcciones);

        // Grupo de campos ocultos de este registro
        const grupoInputs = document.createElement('div');
        grupoInputs.hidden = true;

        const datos = {
            trabajador_id: trabajador.value,
            cantidad: cantidad.value,
            equipo: equipo.value.trim(),
            codigo: codigo.value.trim(),
            marca: marca.value.trim(),
            contrato: contrato.value,
            observaciones: observaciones.value.trim(),
            precio: precio.value,
            estado_id: estado.value,
            fecha_estado: fechaEstado.value
        };

        const indiceActual = indice;

        Object.entries(datos).forEach(([campo, valor]) => {

            const input = document.createElement('input');

            input.type = 'hidden';
            input.name = `detalles_ex[${indiceActual}][${campo}]`;
            input.value = valor;

            grupoInputs.appendChild(input);
        });

        // Conservar el PDF seleccionado
        const inputArchivo = document.createElement('input');

        inputArchivo.type = 'file';
        inputArchivo.name = `detalles_ex[${indiceActual}][adjuntos]`;
        inputArchivo.hidden = true;

        const transferencia = new DataTransfer();
        transferencia.items.add(archivo);

        inputArchivo.files = transferencia.files;

        grupoInputs.appendChild(inputArchivo);

        inputs.appendChild(grupoInputs);
        tabla.appendChild(fila);

        // Eliminar fila y todos sus campos asociados
        botonEliminar.addEventListener('click', function () {
            fila.remove();
            grupoInputs.remove();
        });

        indice++;

        // Limpiar formulario
        trabajador.value = '';
        cantidad.value = '';
        equipo.value = '';
        codigo.value = '';
        marca.value = '';
        contrato.value = '';
        observaciones.value = '';
        precio.value = '';
        adjuntos.value = '';
        estado.value = '';
        fechaEstado.value = '';
    });

});
</script>
