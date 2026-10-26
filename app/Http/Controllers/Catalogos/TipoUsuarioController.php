<?php

namespace App\Http\Controllers\Catalogos;

use App\Http\Controllers\Controller;
use App\Models\Catalogos\TipoUsuario;

class TipoUsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tipo_usuario = TipoUsuario::all();

    return response()->json($tipo_usuario);
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
    public function store(TipoUsuario $request)
    {

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

    public function update(TipoUsuario $request, TipoUsuario $tipo_usuario)
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
