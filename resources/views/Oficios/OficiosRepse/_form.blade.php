@php
    $detalleRepse = $detalleRepse ?? null;

    $valor = function ($campo, $predeterminado = '') use ($detalleRepse) {
        return old(
            'repse.' . $campo,
            $detalleRepse ? $detalleRepse->{$campo} : $predeterminado
        );
    };

    $fechaHora = function ($campo) use ($valor) {
        $fecha = $valor($campo);

        if (!$fecha) {
            return '';
        }

        return \Illuminate\Support\Carbon::parse($fecha)->format('Y-m-d\TH:i');
    };
@endphp

<h2 class="formulario-seccion-titulo">
    Datos del oficio REPSE
</h2>

<div class="formulario-grid">

    {{-- FECHAS --}}

    <div class="campo">
        <label for="repse_fecha_firma">
            Fecha de firma
        </label>

        <input
            type="datetime-local"
            id="repse_fecha_firma"
            name="repse[fecha_firma]"
            value="{{ $fechaHora('fecha_firma') }}"
            required
        >
    </div>

    <div class="campo">
        <label for="repse_fecha_inicio">
            Fecha de inicio
        </label>

        <input
            type="datetime-local"
            id="repse_fecha_inicio"
            name="repse[fecha_inicio]"
            value="{{ $fechaHora('fecha_inicio') }}"
            required
        >
    </div>

    <div class="campo">
        <label for="repse_fecha_fin">
            Fecha de finalización
        </label>

        <input
            type="datetime-local"
            id="repse_fecha_fin"
            name="repse[fecha_fin]"
            value="{{ $fechaHora('fecha_fin') }}"
            required
        >
    </div>

    {{-- CATÁLOGOS --}}

    <div class="campo">
        <label for="repse_contrato_id">
            Contrato
        </label>

        <select
            id="repse_contrato_id"
            name="repse[contrato_id]"
            required
        >
            <option value="">Selecciona un contrato</option>

            @foreach ($contratos as $contrato)
                <option
                    value="{{ $contrato->id }}"
                    @selected($valor('contrato_id') == $contrato->id)
                >
                    {{ $contrato->nombre }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="campo">
        <label for="repse_proveedor_id">
            Proveedor
        </label>

        <select
            id="repse_proveedor_id"
            name="repse[proveedor_id]"
            required
        >
            <option value="">Selecciona un proveedor</option>

            @foreach ($proveedores as $proveedor)
                <option
                    value="{{ $proveedor->id }}"
                    @selected($valor('proveedor_id') == $proveedor->id)
                >
                    {{ $proveedor->nombre }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="campo">
        <label for="repse_empresa_id">
            Empresa
        </label>

        <select
            id="repse_empresa_id"
            name="repse[empresa_id]"
            required
        >
            <option value="">Selecciona una empresa</option>

            @foreach ($empresas as $empresa)
                <option
                    value="{{ $empresa->id }}"
                    @selected($valor('empresa_id') == $empresa->id)
                >
                    {{ $empresa->nombre }}
                </option>
            @endforeach
        </select>
    </div>

    {{-- INFORMACIÓN DEL CONTRATO --}}

    <div class="campo">
        <label for="repse_identificacion_contrato">
            Identificación del contrato
        </label>

        <input
            type="text"
            id="repse_identificacion_contrato"
            name="repse[identificacion_contrato]"
            value="{{ $valor('identificacion_contrato') }}"
            required
        >
    </div>

    <div class="campo">
        <label for="repse_ob_social_ctt">
            Obligación social CTT
        </label>

        <input
            type="text"
            id="repse_ob_social_ctt"
            name="repse[ob_social_ctt]"
            value="{{ $valor('ob_social_ctt') }}"
            required
        >
    </div>

    <div class="campo">
        <label for="repse_ob_social_cts">
            Obligación social CTS
        </label>

        <input
            type="text"
            id="repse_ob_social_cts"
            name="repse[ob_social_cts]"
            value="{{ $valor('ob_social_cts') }}"
            required
        >
    </div>

    {{-- DATOS REPSE --}}

    <div class="campo">
        <label for="repse_numero">
            REPSE
        </label>

        <input
            type="text"
            id="repse_numero"
            name="repse[repse]"
            value="{{ $valor('repse') }}"
            required
        >
    </div>

    <div class="campo">
        <label for="repse_folio_actividad">
            Folio de actividad
        </label>

        <input
            type="text"
            id="repse_folio_actividad"
            name="repse[folio_actividad]"
            value="{{ $valor('folio_actividad') }}"
            required
        >
    </div>

    <div class="campo">
        <label for="repse_actividad">
            Actividad
        </label>

        <input
            type="text"
            id="repse_actividad"
            name="repse[actividad]"
            value="{{ $valor('actividad') }}"
            required
        >
    </div>

    <div class="campo">
        <label for="repse_vigencia">
            Vigencia
        </label>

        <input
            type="text"
            id="repse_vigencia"
            name="repse[vigencia]"
            value="{{ $valor('vigencia') }}"
            required
        >
    </div>

    <div class="campo">
        <label for="repse_servicio_prestado">
            Servicio prestado
        </label>

        <input
            type="text"
            id="repse_servicio_prestado"
            name="repse[servicio_prestado]"
            value="{{ $valor('servicio_prestado') }}"
            required
        >
    </div>

    {{-- INFORMACIÓN ECONÓMICA --}}

    <div class="campo">
        <label for="repse_precio">
            Precio
        </label>

        <input
            type="number"
            step="0.01"
            min="0"
            id="repse_precio"
            name="repse[precio]"
            value="{{ $valor('precio') }}"
            required
        >
    </div>

    <div class="campo">
        <label for="repse_iva">
            IVA
        </label>

        <input
            type="number"
            step="0.01"
            min="0"
            id="repse_iva"
            name="repse[iva]"
            value="{{ $valor('iva') }}"
            required
        >
    </div>

    <div class="campo">
        <label for="repse_total">
            Total
        </label>

        <input
            type="number"
            step="0.01"
            min="0"
            id="repse_total"
            name="repse[total]"
            value="{{ $valor('total') }}"
            required
        >
    </div>

    <div class="campo">
        <label for="repse_pago_servicio">
            Pago del servicio
        </label>

        <input
            type="number"
            step="0.01"
            min="0"
            id="repse_pago_servicio"
            name="repse[pago_servicio]"
            value="{{ $valor('pago_servicio') }}"
            required
        >
    </div>

    {{-- CONTACTOS Y DATOS ADICIONALES --}}

    <div class="campo">
        <label for="repse_correo_contacto">
            Correo de contacto
        </label>

        <input
            type="email"
            id="repse_correo_contacto"
            name="repse[correo_contacto]"
            value="{{ $valor('correo_contacto') }}"
            required
        >
    </div>

    <div class="campo">
        <label for="repse_terminacion">
            Terminación
        </label>

        <input
            type="text"
            id="repse_terminacion"
            name="repse[terminacion]"
            value="{{ $valor('terminacion') }}"
            required
        >
    </div>

    <div class="campo">
        <label for="repse_contacto_contratante">
            Contacto contratante
        </label>

        <input
            type="text"
            id="repse_contacto_contratante"
            name="repse[contacto_contratante]"
            value="{{ $valor('contacto_contratante') }}"
            required
        >
    </div>

    <div class="campo">
        <label for="repse_testigo">
            Testigo
        </label>

        <input
            type="text"
            id="repse_testigo"
            name="repse[testigo]"
            value="{{ $valor('testigo') }}"
            required
        >
    </div>

    <div class="campo">
        <label for="repse_productos">
            Productos
        </label>

        <input
            type="text"
            id="repse_productos"
            name="repse[productos]"
            value="{{ $valor('productos') }}"
            required
        >
    </div>

</div>