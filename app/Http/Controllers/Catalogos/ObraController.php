<?php

namespace App\Http\Controllers\Catalogos;

use App\Http\Controllers\Controller;
use App\Models\Catalogos\Obra;

use App\Http\Requests\Catalogos\{
    UpdateObraRequest,
    StoreObraRequest
};

use Illuminate\Http\Request;

class ObraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $obra = Obra::all();
        return response()->json($obra);
    }

    public function vistaIndex()
    {
        $obras = Obra::all();

        return view(
            'catalogos.obra.index',
            compact('obras')
        );
    }

    public function vistaCreate()
    {
        return view('catalogos.obra.create');
    }

    public function vistaEdit(Obra $obra)
    {
        return view(
            'catalogos.obra.edit',
            compact('obra')
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
    public function store(StoreObraRequest $request)
    {
        $obra = Obra::create($request->validated());

        if ($request->is('api/*')) {
            return response()->json($obra, 201);
        }

        return redirect()
            ->route('obra.index')
            ->with('success', 'Obra registrada correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Obra $obra)
    {
        return response()->json($obra);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Obra $obra)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateObraRequest $request, Obra $obra) 
    {
        $obra->update($request->validated());

        if ($request->is('api/*')) {
            return response()->json($obra);
        }

        return redirect()
            ->route('obra.index')
            ->with('success', 'Obra actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Obra $obra)
    {
        $obra->delete();

        if ($request->is('api/*')) {
            return response()->json(null, 204);
        }

        return redirect()
            ->route('obra.index')
            ->with('success', 'Obra eliminada correctamente.');
    }
}
