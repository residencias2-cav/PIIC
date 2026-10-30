<?php

namespace App\Http\Controllers\Catalogos;

use App\Http\Controllers\Controller;
use App\Models\Catalogos\Gerencia;

use App\Http\Requests\Catalogos\{
    UpdateGerenciaRequest,
    StoreGerenciaRequest
};

use Illuminate\Http\Request;

class GerenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $gerencia = Gerencia::all();
        return response()->json($gerencia);
    }

    public function vistaIndex()
    {
        $gerencias = Gerencia::all();

        return view(
            'catalogos.gerencia.index',
            compact('gerencias')
        );
    }

    public function vistaCreate()
    {
        return view('catalogos.gerencia.create');
    }

    public function vistaEdit(Gerencia $gerencia)
    {
        return view(
            'catalogos.gerencia.edit',
            compact('gerencia')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    
    public function store(StoreGerenciaRequest $request)
    {
        $gerencia = Gerencia::create($request->validated());

        if ($request->is('api/*')) {
            return response()->json($gerencia, 201);
        }

        return redirect()
            ->route('gerencia.index')
            ->with('success', 'Gerencia registrada correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Gerencia $gerencia)
    {
        return response()->json($gerencia);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Gerencia $gerencia)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGerenciaRequest $request, Gerencia $gerencia)
    {
        $gerencia->update($request->validated());

        if ($request->is('api/*')) {
            return response()->json($gerencia);
        }

        return redirect()
            ->route('gerencia.index')
            ->with('success', 'Gerencia actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Gerencia $gerencia)
    {
        $gerencia->delete();

        if ($request->is('api/*')) {
            return response()->json(null, 204);
        }

        return redirect()
            ->route('gerencia.index')
            ->with('success', 'Gerencia eliminada correctamente.');
    }
}
