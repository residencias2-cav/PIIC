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
use App\Models\Catalogos\Articulo;

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

    public function vistaIndex()
    {
        $inventarios = InventarioEpp::with('articulo')
            ->orderBy('id', 'desc')
            ->get();

        return view(
            'Epp.InventarioEpp.index',
            compact('inventarios')
        );
    }

    public function vistaCreate()
    {
        $articulos = Articulo::orderBy('nombre')
            ->get();

        return view(
            'Epp.InventarioEpp.create',
            compact('articulos')
        );
    }

    public function vistaEdit(InventarioEpp $inventario)
    {
        $articulos = Articulo::orderBy('nombre')
            ->get();

        return view(
            'Epp.InventarioEpp.edit',
            compact(
                'inventario',
                'articulos'
            )
        );
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
    public function store(StoreInventarioEppRequest $request, InventarioEpp $inventario_epp)
    {
        $inventario_epp = InventarioEpp::create(
        $request->validated()
        );

        if ($request->is('api/*')) {
            return response()->json([
                'status' => true,
                'message' => 'Inventario EPP registrado correctamente.',
                'data' => $inventario_epp,
            ], 201);
        }

        return redirect()
            ->route('inventario_epp.index')
            ->with(
                'success',
                'Inventario EPP registrado correctamente.'
            );
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
    public function update(UpdateInventarioEppRequest $request,InventarioEpp $inventario) 
    {
        $inventario->update(
            $request->validated()
        );

        if ($request->is('api/*')) {
            return response()->json([
                'status' => true,

                'message' =>
                    'Inventario EPP actualizado correctamente.',

                'data' => $inventario,
            ], 200);
        }

        return redirect()
            ->route('inventario_epp.index')
            ->with(
                'success',
                'Inventario EPP actualizado correctamente.'
            );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request,InventarioEpp $inventario) 
    {
        $inventario->delete();

        if ($request->is('api/*')) {
            return response()->json(null, 204);
        }

        return redirect()
            ->route('inventario_epp.index')
            ->with(
                'success',
                'Registro de Inventario EPP eliminado correctamente.'
            );
    }
}
