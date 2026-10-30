<?php

namespace App\Http\Controllers\Catalogos;

use App\Http\Controllers\Controller;
use App\Models\Catalogos\Ubicacion;

use App\Http\Requests\Catalogos\{
    UpdateUbicacionRequest,
    StoreUbicacionRequest
};

use Illuminate\Http\Request;

class UbicacionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ubicacion = Ubicacion::all();
        return response()->json($ubicacion);
    }

    public function vistaIndex()
    {
        $ubicacions = Ubicacion::all();

        return view(
            'catalogos.ubicacion.index',
            compact('ubicacions')
        );
    }

    public function vistaCreate()
    {
        return view('catalogos.ubicacion.create');
    }

    public function vistaEdit(Ubicacion $ubicacion)
    {
        return view(
            'catalogos.ubicacion.edit',
            compact('ubicacion')
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
    public function store(StoreUbicacionRequest $request)
    {
        $ubicacion = Ubicacion::create($request->validated());

        if ($request->is('api/*')) {
            return response()->json($ubicacion, 201);
        }

        return redirect()
            ->route('ubicacion.index')
            ->with('success', 'Ubicación registrada correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Ubicacion $ubicacion)
    {
        return response()->json($ubicacion);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ubicacion $ubicacion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUbicacionRequest $request, Ubicacion $ubicacion)
    {
        $ubicacion->update($request->validated());

        if ($request->is('api/*')) {
            return response()->json($ubicacion);
        }

        return redirect()
            ->route('ubicacion.index')
            ->with('success', 'Ubicación actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Ubicacion $ubicacion)
    {
        $ubicacion->delete();

        if ($request->is('api/*')) {
            return response()->json(null, 204);
        }

        return redirect()
            ->route('ubicacion.index')
            ->with('success', 'Ubicación eliminada correctamente.');
    }
}
