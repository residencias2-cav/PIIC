<?php

namespace App\Http\Controllers\Api\Epp;

use App\Http\Controllers\Controller;
use App\Http\Requests\Epp\{
    StoreEppRequest,
    UpdateDatosEppTrRequest
    };
use App\Models\Epp\Epp;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EppController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $epp = Epp::all();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): JsonResponse
    {
        //
        $epp = Epp::all();

        return response()->json([
            'status' => true,
            'data' => $epp,
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEppRequest $request)
    {
        //
        $epp =Epp::create($request->validated());

        return response()->json([
            'status' => true,
            'mesage' => 'Epp registrado correctamente',
            'data' => $epp
            ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Epp $epp): JsonResponse
    {
        //
        return response()-> json([
            'status' => true,
            'data' => $epp
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Epp $epp)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Epp $epp)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Epp $epp)
    {
        //
    }
}
