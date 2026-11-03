<?php

namespace App\Http\Controllers\Api\Epp;

use App\Models\Epp\InventarioEpp;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Requests\Epp\{
    StoreInventarioEppRequest, 
    UpdateInventarioEppRequest
    };
use App\Http\Controllers\Controller;

class InventarioEppController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        //
        return response()->json([
            'status' => true,
            'data' => InventarioEpp::all(),
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): JsonResponse
    {
        //
        $inventario_epp = InventarioEpp::all();

        return response()->json([
            'status' => true,
            'data' => $inventario_epp,
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreInventarioEppRequest $request): JsonResponse
    {
        //
        $inventario_epp = InventarioEpp::create($request->validated());

        return response()->json([
            'status' => true,
            'message' => 'Inventario de Epp registrado correctamente',
            'data' => $inventario_epp
            ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(InventarioEpp $inventario_epp)
    {
        //
        return response()->json([
            'status' => true,
            'data' => $inventario_epp,
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(InventarioEpp $inventario_epp)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateInventarioEppRequest $request, InventarioEpp $inventario_epp): JsonResponse
    {
        //
        $inventario_epp->update($request->validated());

        return response()->json([
            'status' => true,
            'message' => 'Inventario de Epp actualizado correctamente',
            'data' => $inventario_epp
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(InventarioEpp $inventario_epp)
    {
        //
        $inventario_epp->delete();

        return response()->json([
            'status' => true,
            'message' => 'Articulo del Inventario de Epp eliminado correctamente',
        ], 200);
    }
}
