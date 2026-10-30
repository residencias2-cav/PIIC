<?php

namespace App\Http\Controllers\Catalogos;

use App\Http\Controllers\Controller;
use App\Models\Catalogos\Empresa;

use App\Http\Requests\Catalogos\{
    UpdateEmpresaRequest,
    StoreEmpresaRequest
};

use Illuminate\Http\Request;

class EmpresaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $empresa = Empresa::all();
        return response()->json($empresa);
    }

    public function vistaIndex()
    {
        $empresas = Empresa::all();

        return view(
            'Catalogos.Empresa.index',
            compact('empresas')
        );
    }

    public function vistaCreate()
    {
        return view('Catalogos.Empresa.create');
    }

    public function vistaEdit(Empresa $empresa)
    {
        return view(
            'Catalogos.Empresa.edit',
            compact('empresa')
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

    public function store(StoreEmpresaRequest $request)
    {
        $empresa = Empresa::create($request->validated());

        if ($request->is('api/*')) {
            return response()->json($empresa, 201);
        }

        return redirect()
            ->route('empresa.index')
            ->with('success', 'Empresa registrada correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Empresa $empresa)
    {
        return response()->json($empresa);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Empresa $empresa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEmpresaRequest $request, Empresa $empresa)
    {
        $empresa->update($request->validated());

        if ($request->is('api/*')) {
            return response()->json($empresa);
        }

        return redirect()
            ->route('empresa.index')
            ->with('success', 'Empresa actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Empresa $empresa)
    {
        $empresa->delete();

        if ($request->is('api/*')) {
            return response()->json(null, 204);
        }

        return redirect()
            ->route('empresa.index')
            ->with('success', 'Empresa eliminada correctamente.');
    }
}
