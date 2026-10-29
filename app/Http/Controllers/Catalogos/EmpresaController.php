<?php

namespace App\Http\Controllers\Catalogos;

use App\Http\Controllers\Controller;
use App\Models\Catalogos\Empresa;

use App\Http\Requests\Catalogos\{
    StoreEmpresaRequest,
    UpdateEmpresaRequest
    };


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

        return response()->json($empresa, 201);
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
        
        return response()->json($empresa);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Empresa $empresa)
    {
        $empresa->delete();
        
        return response()->json(null, 204);
    }
}
