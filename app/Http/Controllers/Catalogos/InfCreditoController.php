<?php

namespace App\Http\Controllers\Catalogos;

use App\Http\Controllers\Controller;
use App\Models\Catalogos\InfCredito;

use App\Http\Requests\Catalogos\{
    UpdateInfCreditoRequest,
    StoreInfCreditoRequest
};

use Illuminate\Http\Request;

class InfCreditoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $inf_credito = InfCredito::all();
        return response()->json($inf_credito);
    }

    public function vistaIndex()
    {
        $infCreditos = InfCredito::all();

        return view(
            'catalogos.InfCredito.index',
            compact('infCreditos')
        );
    }

    public function vistaCreate()
    {
        return view('catalogos.InfCredito.create');
    }

    public function vistaEdit(InfCredito $infCredito)
    {
        return view(
            'catalogos.InfCredito.edit',
            compact('infCredito')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreInfCreditoRequest $request)
    {
        $infCredito = InfCredito::create($request->validated());

        if ($request->is('api/*')) {
            return response()->json($infCredito, 201);
        }

        return redirect()
            ->route('inf_credito.index')
            ->with('success', 'Credito registrado correctamente.');
    }

    /**
     * Display the specified resource.
     */

    public function show(InfCredito $inf_credito)
    {
        return response()->json($inf_credito);
    }

    /**
     * Show the form for editing the specified resource.
     */

    public function edit(InfCredito $inf_credito)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(UpdateInfCreditoRequest $request, InfCredito $infCredito) {
        $infCredito->update($request->validated());

        if ($request->is('api/*')) {
            return response()->json($infCredito);
        }

        return redirect()
            ->route('inf_credito.index')
            ->with('success', 'Crédito actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */

    public function destroy(Request $request, InfCredito $infCredito)
    {
        $infCredito->delete();

        if ($request->is('api/*')) {
            return response()->json(null, 204);
        }

        return redirect()
            ->route('inf_credito.index')
            ->with('success', 'Crédito eliminado correctamente.');
    }
}