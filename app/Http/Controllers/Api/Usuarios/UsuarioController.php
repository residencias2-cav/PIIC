<?php

namespace App\Http\Controllers;

use App\Models\Usuarios\Usuario;
use Illuminate\Http\Request;
use App\Http\Requests\Usuarios\{
    StoreUsuarioRequest,
    UpdateUsuarioRequest
    };

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return response()->json([
            'data' => Usuario::all(),
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $usuario = Usuario::all();

        return response()->json([
            'status' => true,
            'data' => $usuario,
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUsuarioRequest $request)
    {
        //
        $usuario = Usuario::create($request->validated());

        return response()->json([
            'status' => true,
            'message' => 'Usuario registrado correctamente',
            'data' => $usuario
            ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Usuario $usuario)
    {
        //
        return response()->json([
            'status' => true,
            'data' => $usuario,
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Usuario $usuario)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUsuarioRequest $request, Usuario $usuario)
    {
        //

        $usuario->update($request->validated());

        return response()->json([
            'status' => true,
            'message' => 'Usuario actualizado correctamente',
            'data' => $usuario
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Usuario $usuario)
    {
        //

        $usuario->delete();

        return response()->json([
            'status' => true,
            'message' => 'Usuario eliminado correctamente',
        ], 200);
    }
}
