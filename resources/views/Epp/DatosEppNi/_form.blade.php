<section
    id="seccion-epp-tr"
    class="formulario-seccion detalle-epp"
    style="display: none;"
>

    <h2 class="formulario-seccion-titulo">
        Detalle EPP NI
    </h2>

    <div class="formulario-grid">
        <div class="campo">

        <label for="ni_trabajador_id">
            Trabajador
        </label>

        <select id="ni_trabajador_id">

            <option value="">trabajador
            </option>

            @foreach ($trabajadors as $trabajador)

                <option value="{{ $trabajador->id }}">
                    {{ $trabajador->nombre}}
                </option>

                <option value="{{ $trabajador->id }}">
                    {{ $trabajador->apellido_paterno}}
                </option>

                <option value="{{ $trabajador->id }}">
                    {{ $trabajador->apellido_materno}}
                </option>

            @endforeach

        </select>

        <select id="ni_articulo_id">

            <option value="">articulo
            </option>

            @foreach ($articulos as $articulo)

                <option value="{{ $articulo->id }}">
                    {{ $articulo->nombre}}
                </option>

            @endforeach

        </select>

        <div class="campo">

            <label for="ni_sup_int">
                Superficie o interior mina
            </label>

            <textarea
                id="ni_sup_int"
                rows="3"
                maxlength="50"
            ></textarea>

        </div>

        <button
            type="button"
            id="agregar-tr"
            class="btn btn-principal"
        >
            + Agregar elemento
        </button>

        <div class="tabla-responsive">

        <table class="catalogo-tabla">

            <thead>
                <tr>
                    <th>Trabajador</th>
                    <th>Artículo</th>
                    <th>sup_int</th>
                </tr>
            </thead>

            <tbody id="lista-elementos-tr">

                <tr id="ni-vacio">

                    <td
                        colspan="9"
                        class="estado-vacio"
                    >
                        No hay elementos agregados.
                    </td>

                </tr>

            </tbody>

        </table>

    </div>

    <div id="inputs-ocultos-ni"></div>

    </div>
</section>