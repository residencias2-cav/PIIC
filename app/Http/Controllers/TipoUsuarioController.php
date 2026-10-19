<?php

namespace App\Http\Controllers;

use App\Models\TipoUsuario;
use App\Http\Requests\StoreTipoUsuarioRequest;
use Illuminate\Http\Request;

class TipoUsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(StoreTipoUsuarioRequest $request)
    {
        $tipo_usuario = TipoUsuario::create($request->validated());

        return response()->json($tipo_usuario, 201);
    }

    /**
     * Display the specified resource.
     */

    public function show(TipoUsuario $tipo_usuario)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */

    public function edit(TipoUsuario $tipo_usuario)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, TipoUsuario $tipo_usuario)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */

    public function destroy(TipoUsuario $tipo_usuario)
    {
        //
    }
}
