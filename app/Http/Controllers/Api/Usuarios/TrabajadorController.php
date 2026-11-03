<?php

namespace App\Http\Controllers\Api\Usuarios;

use App\Http\Controllers\Controller;
use App\Models\Usuarios\Trabajador;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Requests\Usuarios\{
    StoreTrabajadorRequest,
    UpdateTrabajadorRequest
};

class TrabajadorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        //
        return response()->json([
            'data' => Trabajador::all(),
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): JsonResponse
    {
        //
        $trabajadores = Trabajador::all();

        return response()->json([
            'status' => true,
            'data' => $trabajadores,
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTrabajadorRequest $request): JsonResponse
    {
        //
        $trabajador = Trabajador::create($request->validated());

        return response()->json([
            'status' => true,
            'message' => 'Trabajador registrado correctamente',
            'data' => $trabajador,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Trabajador $trabajador): JsonResponse
    {
        return response()->json([
            'status' => true,
            'data' => $trabajador,
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Trabajador $trabajador)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTrabajadorRequest $request, Trabajador $trabajador)
    {
        //
        $trabajador->update($request->validated());

        return response()->json([
            'status' => true,
            'message' => 'Trabajador actualizado correctamente',
            'data' => $trabajador,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Trabajador $trabajador)
    {
        //

        $trabajador->delete();

        return response()->json([
            'status' => true,
            'message' => 'Trabajador eliminado correctamente',
        ], 200);
    }
}
