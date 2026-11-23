<?php

namespace App\Http\Controllers\Api\Compras;

use App\Http\Controllers\Controller;
use App\Http\Requests\Compras\StoreCotizacionRequest;
use App\Http\Requests\Compras\UpdateCotizacionRequest;

use App\Models\Compras\Cotizacion;
use App\Models\Compras\DatosCotizacion;
use App\Models\Compras\FolioCompras;
use App\Models\Compras\Pedido;

use App\Models\Catalogos\{
    Gerencia,
    Proyecto,
    TipoCotizacion,
    EstadoPedido,
    Lugar,
    Obra,
    Unidad
};

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CotizacionController extends Controller
{
    /**
     * Mostrar todas las cotizaciones.
     */
    public function index()
    {
        $cotizaciones = Cotizacion::with([
            'pedido',
            'gerencia',
            'proyecto',
            'obra',
            'lugar',
            'tipoCotizacion',
            'estadoPedido',
            'folioCompras',
            'datosCotizacion.unidad'
        ])
        ->orderByDesc('id')
        ->paginate(10);

        return view('compras.cotizacion.index', compact('cotizaciones'));
    }

    /**
     * Mostrar formulario de registro.
     */
    public function create()
    {
        $catalogos = $this->cargarCatalogos();

        return view('compras.cotizacion.create', $catalogos);
    }

    /**
     * Guardar una cotización y sus detalles.
     */
    public function store(StoreCotizacionRequest $request)
    {
        $datos = $request->validated();

        $detalles = $datos['datos_cotizacion'];

        unset($datos['datos_cotizacion']);

        DB::transaction(function () use ($datos, $detalles) {

            $cotizacion = Cotizacion::create($datos);

            foreach ($detalles as $detalle) {
                $cotizacion->datosCotizacion()->create($detalle);
            }
        });

        return redirect()
            ->route('compras.cotizacion.index')
            ->with('success', 'Cotización registrada correctamente.');
    }

    /**
     * Mostrar una cotización.
     */
    public function show(Cotizacion $cotizacion)
    {
        $cotizacion->load([
            'pedido',
            'gerencia',
            'proyecto',
            'obra',
            'lugar',
            'tipoCotizacion',
            'estadoPedido',
            'folioCompras',
            'datosCotizacion.unidad'
        ]);

        return view('compras.cotizacion.show', compact('cotizacion'));
    }

    /**
     * Mostrar formulario de edición.
     */
    public function edit(Cotizacion $cotizacion)
    {
        $cotizacion->load('datosCotizacion.unidad');

        $catalogos = $this->cargarCatalogos();

        return view(
            'compras.cotizacion.edit',
            array_merge($catalogos, compact('cotizacion'))
        );
    }

    /**
     * Actualizar cotización y sus detalles.
     */
    public function update(
        UpdateCotizacionRequest $request,
        Cotizacion $cotizacion
    ) {
        $datos = $request->validated();

        $detalles = $datos['datos_cotizacion'] ?? null;

        unset($datos['datos_cotizacion']);

        DB::transaction(function () use ($datos, $detalles, $cotizacion) {

            $cotizacion->update($datos);

            if (is_array($detalles)) {

                $idsActualizados = [];

                foreach ($detalles as $detalle) {

                    $id = $detalle['id'] ?? null;

                    unset($detalle['id']);

                    if ($id) {
                        $registro = $cotizacion->datosCotizacion()
                            ->where('id', $id)
                            ->first();
                    } else {
                        $registro = null;
                    }

                    if ($registro) {
                        $registro->update($detalle);
                    } else {
                        $registro = $cotizacion->datosCotizacion()
                            ->create($detalle);
                    }

                    $idsActualizados[] = $registro->id;
                }

                $cotizacion->datosCotizacion()
                    ->whereNotIn('id', $idsActualizados)
                    ->delete();
            }
        });

        return redirect()
            ->route('compras.cotizacion.index')
            ->with('success', 'Cotización actualizada correctamente.');
    }

    /**
     * Eliminar una cotización.
     */
    public function destroy(Cotizacion $cotizacion)
    {
        $cotizacion->delete();

        return redirect()
            ->route('compras.cotizacion.index')
            ->with('success', 'Cotización eliminada correctamente.');
    }

    /**
     * Cargar los catálogos necesarios para los formularios.
     */
    private function cargarCatalogos(): array
    {
        return [
            'pedidos' => Pedido::orderByDesc('id')->get(),

            'gerencias' => Gerencia::orderBy('nombre')->get(),

            'foliosCompras' => FolioCompras::orderByDesc('id')->get(),

            'proyectos' => Proyecto::orderBy('nombre')->get(),

            'obras' => Obra::orderBy('nombre_obra')->get(),

            'lugares' => Lugar::orderBy('nombre_municipio')->get(),

            'tiposCotizacion' => TipoCotizacion::orderBy('nombre')->get(),

            'estadosPedido' => EstadoPedido::orderBy('nombre')->get(),

            'unidades' => Unidad::orderBy('nombre')->get(),
        ];
    }
}