<?php

namespace App\Http\Controllers\Epp;

use App\Http\Controllers\Controller;
use App\Models\Epp\DatosEppTr;
use Illuminate\Http\Request;
use App\Http\Requests\Epp\{
    StoreDatosEppTrRequest,
    UpdateDatosEppTrRequest
    };

class DatosEppTrController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return response()->json([
            'status' => true,
            'data' => DatosEppTr::all(),
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $datosepptr = DatosEppTr::all();

        return response()->json([
            'status' => true,
            'data' => $datosepptr,
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDatosEppTrRequest $request)
    {
        //
        $datosepptr = DatosEppTr::create($request->validated());

        return response()->json([
            'status' => true,
            'message' => 'Datos Epp Tr registrado correctamente',
            'data' => $datosepptr
            ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(DatosEppTr $datosEppTr)
    {
        //
        return response()->json([
            'status' => true,
            'data' => $datosEppTr,
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DatosEppTr $datosEppTr)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDatosEppTrRequest $request, DatosEppTr $datosEppTr)
    {
        //
        $datosEppTr->update($request->validated());

        return response()->json([
            'status' => true,
            'message' => 'Datos Epp Tr actualizado correctamente',
            'data' => $datosEppTr
            ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DatosEppTr $datosEppTr)
    {
        //
        $datosEppTr->delete();

        return response()->json([
            'status' => true,
            'message' => 'Datos Epp Tr eliminado correctamente',
        ], 200);
    }
}
