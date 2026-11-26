<?php

namespace App\Http\Controllers\Api\Oficios;

use App\Http\Controllers\Controller;
use App\Models\Oficios\Mantenimientos;
use App\Models\Compras\Pedido;
use App\Models\Catalogos\Gerencia;
use App\Models\Usuarios\Trabajador;
use App\Models\Compras\AutorizadoPor;
use Illuminate\Http\Request;

class MantenimientosController extends Controller
{
    public function vistaIndex()
    {
        $mantenimientos = Mantenimientos::with([
            'pedido',
            'trabajador',
            'gerencia',
            'autorizadoPor.trabajador',
            'autorizadoPor.epp'
        ])
            ->orderByDesc('id')
            ->paginate(10);

        return view('Oficios.Mantenimientos.index', compact('mantenimientos'));
    }

    public function vistaCreate()
    {
        $pedidos = Pedido::orderByDesc('id')->get();

        $trabajadores = Trabajador::orderBy('nombre')
            ->orderBy('apellido_paterno')
            ->orderBy('apellido_materno')
            ->get();

        $gerencias = Gerencia::orderBy('code')->get();

        $autorizados = AutorizadoPor::with([
            'trabajador',
            'epp'
        ])
            ->orderBy('id')
            ->get();

        return view('Oficios.Mantenimientos.create', compact(
            'pedidos',
            'trabajadores',
            'gerencias',
            'autorizados'
        ));
    }

    public function store(Request $request)
    {
        $datos = $request->validate([
            'pedido_id' => 'required|exists:pedidos,id',
            'fecha' => 'required|date',
            'trabajador_id' => 'required|exists:trabajadors,id',
            'gerencia_id' => 'required|exists:gerencias,id',
            'folio' => 'required|string|max:20',
            'lugar' => 'required|string|max:150',
            'descripcion' => 'required|string|max:150',
            'material_necesario' => 'required|string',
            'autorizado_por_id' => 'required|exists:autorizado_pors,id',
            'surtido' => 'required|boolean',
        ]);

        Mantenimientos::create($datos);

        return redirect()
            ->route('mantenimientos.index')
            ->with('success', 'Mantenimiento registrado correctamente.');
    }

    public function vistaEdit(Mantenimientos $mantenimiento)
    {
        $pedidos = Pedido::orderByDesc('id')->get();

        $trabajadores = Trabajador::orderBy('nombre')
            ->orderBy('apellido_paterno')
            ->orderBy('apellido_materno')
            ->get();

        $gerencias = Gerencia::orderBy('code')->get();

        $autorizados = AutorizadoPor::with([
            'trabajador',
            'epp'
        ])
            ->orderBy('id')
            ->get();

        return view('Oficios.Mantenimientos.edit', compact(
            'mantenimiento',
            'pedidos',
            'trabajadores',
            'gerencias',
            'autorizados'
        ));
    }

    public function update(Request $request, Mantenimientos $mantenimiento)
    {
        $datos = $request->validate([
            'pedido_id' => 'required|exists:pedidos,id',
            'fecha' => 'required|date',
            'trabajador_id' => 'required|exists:trabajadors,id',
            'gerencia_id' => 'required|exists:gerencias,id',
            'folio' => 'required|string|max:20',
            'lugar' => 'required|string|max:150',
            'descripcion' => 'required|string|max:150',
            'material_necesario' => 'required|string',
            'autorizado_por_id' => 'required|exists:autorizado_pors,id',
            'surtido' => 'required|boolean',
        ]);

        $mantenimiento->update($datos);

        return redirect()
            ->route('mantenimientos.index')
            ->with('success', 'Mantenimiento actualizado correctamente.');
    }

    public function destroy(Mantenimientos $mantenimiento)
    {
        $mantenimiento->delete();

        return redirect()
            ->route('mantenimientos.index')
            ->with('success', 'Mantenimiento eliminado correctamente.');
    }
}