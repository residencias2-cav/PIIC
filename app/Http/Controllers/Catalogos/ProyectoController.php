<?php

namespace App\Http\Controllers\Catalogos;

use App\Http\Controllers\Controller;
use App\Models\Catalogos\Proyecto;

use App\Http\Requests\Catalogos\{
    UpdateProyectoRequest,
    StoreProyectoRequest
};

use Illuminate\Http\Request;

class ProyectoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $proyecto = Proyecto::all();
        return response()->json($proyecto);
    }

    public function vistaIndex()
    {
        $proyectos = Proyecto::all();

        return view(
            'catalogos.proyecto.index',
            compact('proyectos')
        );
    }

    public function vistaCreate()
    {
        return view('catalogos.proyecto.create');
    }

    public function vistaEdit(Proyecto $proyecto)
    {
        return view(
            'catalogos.proyecto.edit',
            compact('proyecto')
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
    public function store(StoreProyectoRequest $request)
    {
        $proyecto = Proyecto::create($request->validated());

        if ($request->is('api/*')) {
            return response()->json($proyecto, 201);
        }

        return redirect()
            ->route('proyecto.index')
            ->with('success', 'Proyecto registrado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Proyecto $proyecto)
    {
        return response()->json($proyecto);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Proyecto $proyecto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProyectoRequest $request, Proyecto $proyecto) 
    {
        $proyecto->update($request->validated());

        if ($request->is('api/*')) {
            return response()->json($proyecto);
        }

        return redirect()
            ->route('proyecto.index')
            ->with('success', 'Proyecto actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Proyecto $proyecto)
    {
        $proyecto->delete();

        if ($request->is('api/*')) {
            return response()->json(null, 204);
        }

        return redirect()
            ->route('proyecto.index')
            ->with('success', 'Proyecto eliminado correctamente.');
    }
}
