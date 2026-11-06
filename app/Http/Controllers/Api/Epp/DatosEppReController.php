<?php

namespace App\Http\Controllers\Api\Epp;

use App\Http\Controllers\Controller;
use App\Http\Requests\Epp\{
    StoreDatosEppReRequest,
    UpdateDatosEppReRequest
};
use App\Models\Epp\DatosEppRe;
use Illuminate\Http\Request;

class DatosEppReController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return response() -> json([
            'data' => DatosEppRe::all()
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $datos_epp_re = DatosEppRe::all();
        
        return response()->json([
            'status' => true,
            'data' => $datos_epp_re,
        ]);
    }
        
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDatosEppReRequest $request)
    {
        $datos_epp_re = DatosEppRe::create($request->validated());

        return response()->json([
            'status' => true,
            'message' => 'Datos de EPP registrados correctamente',
            'data' => $datos_epp_re,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(DatosEppRe $datos_epp_re)
    {
        //


        return response()->json([
            'status' => true,
            'data' => $datos_epp_re,
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DatosEppRe $datos_epp_re)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDatosEppReRequest $request, DatosEppRe $datos_epp_re)
    {
        $datos_epp_re->update($request->validated());

        return response()->json([
            'status' => true,
            'message' => 'Datos de EPP actualizados correctamente',
            'data' => $datos_epp_re,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DatosEppRe $datos_epp_re)
    {
        $datos_epp_re->delete();

        return response()->json([
            'status' => true,
            'message' => 'Datos EPP eliminados correctamente',
        ]);
    }
}
