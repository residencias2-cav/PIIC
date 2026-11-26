<?php

namespace App\Http\Controllers\Api\Compras;

use App\Http\Controllers\Controller;
use App\Models\Compras\Autorizacion;
use Illuminate\Http\Request;

class AutorizacionController extends Controller
{
    public function vistaIndex()
    {
        $autorizaciones = Autorizacion::with([
            'usuario.trabajador',
            'pedido'
        ])
            ->where('proceso_autorizado', false)
            ->orderByDesc('id')
            ->paginate(10);

        return view('Compras.Autorizacion.index', compact('autorizaciones'));
    }

    public function vistaCreate()
    {
        return redirect()->route('autorizacion.index');
    }

    public function store(Request $request)
    {
        return redirect()
            ->route('autorizacion.index')
            ->with('error', 'Las autorizaciones se generan mediante el proceso de pedidos.');
    }

    
    public function vistaEdit(Autorizacion $autorizacion)
    {
        if ($autorizacion->proceso_autorizado) {
            return redirect()
                ->route('autorizacion.index')
                ->with('error', 'Esta autorización ya fue procesada.');
        }

        $autorizacion->load([
            'usuario.trabajador',
            'pedido.tipoPedido',
            'pedido.gerencia',
            'pedido.empresa',
            'pedido.detallesPedido.unidad',
            'pedido.pedidosInternos.tipoServicio'
        ]);

        return view('Compras.Autorizacion.edit', compact('autorizacion'));
    }


    public function update(Request $request, Autorizacion $autorizacion)
    {
        if ($autorizacion->proceso_autorizado) {
            return redirect()
                ->route('autorizacion.index')
                ->with('error', 'Esta autorización ya fue procesada.');
        }

        $datos = $request->validate([
            'observaciones' => 'nullable|string|max:150',
        ]);

        $autorizacion->update([
            'proceso_autorizado' => true,
            'fecha_autorizacion' => now()->format('d/m/Y H:i'),
            'observaciones' => $datos['observaciones'] ?? $autorizacion->observaciones,
        ]);

        return redirect()
            ->route('autorizacion.index')
            ->with('success', 'El pedido fue autorizado correctamente.');
    }

    public function destroy(Autorizacion $autorizacion)
    {
        return redirect()
            ->route('autorizacion.index')
            ->with('error', 'No se permite eliminar autorizaciones desde este módulo.');
    }
}