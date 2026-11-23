<?php

namespace App\Http\Controllers\Api\Compras;

use App\Http\Controllers\Controller;
use App\Models\Compras\AutorizadoPor;
use App\Models\Epp\Epp;
use App\Models\Usuarios\Trabajador;
use Illuminate\Http\Request;

class AutorizadoPorController extends Controller
{
    /**
     * Mostrar las autorizaciones registradas.
     */
    public function index()
    {
        $autorizadoPors = AutorizadoPor::with([
            'trabajador',
            'epp'
        ])
        ->orderByDesc('id')
        ->paginate(10);

        return view(
            'Compras.AutorizadoPor.index',
            compact('autorizadoPors')
        );
    }

    /**
     * Mostrar formulario de registro.
     */
    public function create()
    {
        $trabajadores = Trabajador::orderBy('nombre')->get();
        $epps = Epp::orderByDesc('id')->get();

        return view(
            'Compras.AutorizadoPor.create',
            compact('trabajadores', 'epps')
        );
    }

    /**
     * Guardar una autorización.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'trabajador_id' => [
                'required',
                'integer',
                'exists:trabajadors,id'
            ],
            'epp_id' => [
                'required',
                'integer',
                'exists:epps,id'
            ],
            'proceso_autorizado' => [
                'required',
                'boolean'
            ],
            'fecha_autorizacion' => [
                'required',
                'date'
            ],
            'observaciones' => [
                'required',
                'string',
                'max:100'
            ],
        ]);

        AutorizadoPor::create($validated);

        return redirect()
            ->route('autorizado_por.index')
            ->with('success', 'Autorización registrada correctamente.');
    }

    /**
     * Mostrar una autorización.
     */
    public function show(AutorizadoPor $autorizado_por)
    {
        return redirect()->route('autorizado_por.edit', $autorizado_por);
    }

    /**
     * Mostrar formulario de edición.
     */
    public function edit(AutorizadoPor $autorizado_por)
    {
        $trabajadores = Trabajador::orderBy('nombre')->get();
        $epps = Epp::orderByDesc('id')->get();

        $autorizadoPor = $autorizado_por;

        return view(
            'Compras.AutorizadoPor.edit',
            compact('autorizadoPor', 'trabajadores', 'epps')
        );
    }

    /**
     * Actualizar una autorización.
     */
    public function update(Request $request, AutorizadoPor $autorizado_por)
    {
        $validated = $request->validate([
            'trabajador_id' => [
                'required',
                'integer',
                'exists:trabajadors,id'
            ],
            'epp_id' => [
                'required',
                'integer',
                'exists:epps,id'
            ],
            'proceso_autorizado' => [
                'required',
                'boolean'
            ],
            'fecha_autorizacion' => [
                'required',
                'date'
            ],
            'observaciones' => [
                'required',
                'string',
                'max:100'
            ],
        ]);

        $autorizado_por->update($validated);

        return redirect()
            ->route('autorizado_por.index')
            ->with('success', 'Autorización actualizada correctamente.');
    }

    /**
     * Eliminar una autorización.
     */
    public function destroy(AutorizadoPor $autorizado_por)
    {
        $autorizado_por->delete();

        return redirect()
            ->route('autorizado_por.index')
            ->with('success', 'Autorización eliminada correctamente.');
    }
}