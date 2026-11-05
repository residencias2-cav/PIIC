<?php

namespace App\Http\Controllers\Api\Epp;

use App\Http\Controllers\Controller;
use App\Http\Requests\Epp\{
    StoreEppRequest,
    UpdateEppRequest
    };
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

use App\Models\Epp\Epp;

use App\Models\Catalogos\{
    TipoEpp,
    Obra,
    Empresa
};

class EppController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        //
        return response()->json([
            'data' => Epp::all(),
        ], 200);
    }

    public function vistaIndex()
    {
        $epps = Epp::with([
            'tipoEpp',
            'obra',
            'empresa',
        ])
            ->latest('fecha')
            ->get();

        return view(
            'Epp.Epp.index',
            compact('epps')
        );
    }

    public function vistaCreate()
    {
        $tiposEpp = TipoEpp::all();

        $obras = Obra::orderBy('nombre_obra')->get();

        $empresas = Empresa::orderBy('nombre')->get();

        return view(
            'Epp.Epp.create',
            compact(
                'tiposEpp',
                'obras',
                'empresas'
            )
        );
    }

    public function vistaEdit(Epp $epp)
    {
        $tiposEpp = TipoEpp::all();

        $obras = Obra::orderBy('nombre_obra')->get();

        $empresas = Empresa::orderBy('nombre')->get();

        return view(
            'Epp.Epp.edit',
            compact(
                'epp',
                'tiposEpp',
                'obras',
                'empresas'
            )
        );
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
        $datos = $request->validated();

        $epp = Epp::create($datos);

        if ($request->is('api/*')) {
            return response()->json($epp, 201);
        }

        return redirect()
            ->route('epp.index')
            ->with(
                'success',
                'Solicitud de EPP registrada correctamente.'
            );
    }

    /**
     * Display the specified resource.
     */
    public function show(Epp $epp): JsonResponse
    {
        //
        return response()-> json([
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
    public function update(UpdateEppRequest $request, Epp $epp) 
    {
        $epp->update($request->validated());

        if ($request->is('api/*')) {
            return response()->json($epp);
        }

        return redirect()
            ->route('epp.index')
            ->with(
                'success',
                'Solicitud de EPP actualizada correctamente.'
            );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Epp $epp)
    {
        $epp->delete();

        if ($request->is('api/*')) {
            return response()->json(null, 204);
        }

        return redirect()
            ->route('epp.index')
            ->with(
                'success',
                'Solicitud de EPP eliminada correctamente.'
            );
    }
}
