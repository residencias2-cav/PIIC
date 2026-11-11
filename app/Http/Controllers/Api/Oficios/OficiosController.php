<?php

namespace App\Http\Controllers\Api\Oficios;

use App\Models\Oficios\Oficios;
use App\Http\Requests\Oficios\{
    StoreOficiosRequest,
    UpdateOficiosRequest
    };
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OficiosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return response()->json([
            'data' => Oficios::all(),
        ], 200);
    }

    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $oficios = Oficios::all();

        return response()->json([
            'status' => true,
            'data' => $oficios,
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOficiosRequest $request)
    {
        //
        $oficios = Oficios::create($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Oficio registrado correctamente',
            'data' => $oficios
            ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Oficios $oficios)
    {
        //

        return response()->json([
            'status' => true,
            'data' => $oficios
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Oficios $oficios)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOficiosRequest $request, Oficios $oficios)
    {
        //
        $oficios->update($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Oficio actualizado correctamente',
            'data' => $oficios
            ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Oficios $oficios)
    {
        //
        $oficios->delete();

        return response()->json([
            'status' => true,
            'message' => 'Oficio eliminado correctamente',
            'data' => $oficios
            ], 200);
    }
}
