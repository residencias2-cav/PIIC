<?php

namespace App\Http\Controllers\Api\Proveedores;

use App\Http\Controllers\Controller;
use App\Models\Proveedores\InformacionBancaria;
use App\Models\Proveedores\Proveedor;
use Illuminate\Http\Request;

class InformacionBancariaController extends Controller
{
    public function vistaIndex()
    {
        $informaciones = InformacionBancaria::with('proveedor')
            ->orderByDesc('id')
            ->paginate(10);

        return view('Proveedores.InformacionBancaria.index', compact('informaciones'));
    }

    public function vistaCreate()
    {
        $proveedores = Proveedor::orderBy('nombre')->get();

        return view('Proveedores.InformacionBancaria.create', compact('proveedores'));
    }

    public function store(Request $request)
    {
        $datos = $request->validate([
            'nombre_banco' => 'required|string|max:50',
            'nombre_titular' => 'required|string|max:100',
            'cuenta' => 'required|string|size:11',
            'clave' => 'required|string|size:18',
            'proveedor_id' => 'required|exists:proveedors,id',
        ]);

        InformacionBancaria::create($datos);

        return redirect()
            ->route('informacion_bancaria.index')
            ->with('success', 'Información bancaria registrada correctamente.');
    }

    public function vistaEdit(InformacionBancaria $informacion_bancaria)
    {
        $proveedores = Proveedor::orderBy('nombre')->get();

        return view(
            'Proveedores.InformacionBancaria.edit',
            compact('informacion_bancaria', 'proveedores')
        );
    }

    public function update(Request $request, InformacionBancaria $informacion_bancaria)
    {
        $datos = $request->validate([
            'nombre_banco' => 'required|string|max:50',
            'nombre_titular' => 'required|string|max:100',
            'cuenta' => 'required|string|size:11',
            'clave' => 'required|string|size:18',
            'proveedor_id' => 'required|exists:proveedors,id',
        ]);

        $informacion_bancaria->update($datos);

        return redirect()
            ->route('informacion_bancaria.index')
            ->with('success', 'Información bancaria actualizada correctamente.');
    }

    public function destroy(InformacionBancaria $informacion_bancaria)
    {
        $informacion_bancaria->delete();

        return redirect()
            ->route('informacion_bancaria.index')
            ->with('success', 'Información bancaria eliminada correctamente.');
    }
}