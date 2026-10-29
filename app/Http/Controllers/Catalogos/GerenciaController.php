<?php

namespace App\Http\Controllers\Catalogos;

use App\Http\Controllers\Controller;
use App\Models\Catalogos\Gerencia;

use App\Http\Requests\Catalogos\{
    StoreGerenciaRequest,
    UpdateGerenciaRequest
    };

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

        return response()->json($gerencia, 201);
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
        
        return response()->json($gerencia);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Gerencia $gerencia)
    {
        $gerencia->delete();
        
        return response()->json(null, 204);
    }
}
