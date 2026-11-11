<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDatosEppNiRequest;
use App\Http\Requests\UpdateDatosEppNiRequest;
use App\Models\Epp\DatosEppNi;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DatosEppNiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return response()->json([
            'data' => DatosEppNi::all(),
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $datos_epp_ni = DatosEppNi::all();

        return response()->json([
            'status' => true,
            'data' => $datos_epp_ni,
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDatosEppNiRequest $request)
    {
        //
        $datos_epp_ni = DatosEppNi::create($request->validated());

        return response()->json([
            'status' => true,
            'message' => 'Dato Epp de nuevo ingreso registrado correctamente',
            'data' => $datos_epp_ni, 
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(DatosEppNi $datos_epp_ni)
    {
        //
        return response()->json([
            'status' => true,
            'data' => $datos_epp_ni
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DatosEppNi $datos_epp_ni)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDatosEppNiRequest $request, DatosEppNi $datos_epp_ni)
    {
        //
        $datos_epp_ni ->update($request->validated());

        return response()->json([
            'status' => true,
            'message' => 'Dato EPP de nuevo ingreso actualizado exitosamente',
            'data' => $datos_epp_ni,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DatosEppNi $datos_epp_ni)
    {
        //

        $datos_epp_ni->delete();
    }
}
