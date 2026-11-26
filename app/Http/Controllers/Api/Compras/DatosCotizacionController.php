<?php

namespace App\Http\Controllers\Api\Compras;

use App\Http\Controllers\Controller;
use App\Models\Compras\DatosCotizacion;
use App\Models\Compras\Cotizacion;
use App\Models\Catalogos\Unidad;
use Illuminate\Http\Request;

class DatosCotizacionController extends Controller
{
    public function vistaIndex()
    {
        $datosCotizacion = DatosCotizacion::with([
            'cotizacion',
            'unidad'
        ])
            ->orderByDesc('id')
            ->paginate(10);

        return view('Compras.DatosCotizacion.index', compact('datosCotizacion'));
    }

    public function vistaCreate()
    {
        $cotizaciones = Cotizacion::orderByDesc('id')->get();
        $unidades = Unidad::orderBy('nombre')->get();

        return view('Compras.DatosCotizacion.create', compact(
            'cotizaciones',
            'unidades'
        ));
    }

    public function store(Request $request)
    {
        $datos = $request->validate([
            'cotizacion_id' => 'required|exists:cotizacions,id',
            'unidad_id' => 'required|exists:unidads,id',
            'descripcion' => 'required|string|max:150',
            'codigo' => 'required|string|max:150',
            'entregado' => 'required|boolean',
            'fecha_r' => 'required|string|max:150',
        ]);

        DatosCotizacion::create($datos);

        return redirect()
            ->route('datos_cotizacion.index')
            ->with('success', 'Dato de cotización registrado correctamente.');
    }

    public function vistaEdit(DatosCotizacion $datos_cotizacion)
    {
        $cotizaciones = Cotizacion::orderByDesc('id')->get();
        $unidades = Unidad::orderBy('nombre')->get();

        return view('Compras.DatosCotizacion.edit', compact(
            'datos_cotizacion',
            'cotizaciones',
            'unidades'
        ));
    }

    public function update(Request $request, DatosCotizacion $datos_cotizacion)
    {
        $datos = $request->validate([
            'cotizacion_id' => 'required|exists:cotizacions,id',
            'unidad_id' => 'required|exists:unidads,id',
            'descripcion' => 'required|string|max:150',
            'codigo' => 'required|string|max:150',
            'entregado' => 'required|boolean',
            'fecha_r' => 'required|string|max:150',
        ]);

        $datos_cotizacion->update($datos);

        return redirect()
            ->route('datos_cotizacion.index')
            ->with('success', 'Dato de cotización actualizado correctamente.');
    }

    public function destroy(DatosCotizacion $datos_cotizacion)
    {
        $datos_cotizacion->delete();

        return redirect()
            ->route('datos_cotizacion.index')
            ->with('success', 'Dato de cotización eliminado correctamente.');
    }
}