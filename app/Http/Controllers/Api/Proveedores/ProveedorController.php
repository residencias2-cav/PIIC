<?php

namespace App\Http\Controllers;

use App\Models\Proveedores\Proveedor;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\Proveedores\{
    StoreProveedorRequest,
    UpdateProveedorRequest
    };

class ProveedorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        //
        return response()->json([
            'data' => Proveedor::all(),
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): JsonResponse
    {
        //
        $proveedor = Proveedor::all();
        
        return response()->json([
            'status' => true,
            'data' => $proveedor,
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProveedorRequest $request): JsonResponse
    {
        //
        $proveedor = Proveedor::create($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Proveedor registrado correctamente',
            'data' => $proveedor
            ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Proveedor $proveedor): JsonResponse
    {
        //
        return response()->json([
            'status' => true,
            'data' => $proveedor,
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Proveedor $proveedor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProveedorRequest $request, Proveedor $proveedor)
    {
        //
        $proveedor->update($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Proveedor actualizado correctamente',
            'data' => $proveedor
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Proveedor $proveedor)
    {
        //
        $proveedor->delete();

        return response()->json([
            'status' => true,
            'message' => 'Proveedor eliminado correctamente'
        ], 200);
    }
}
