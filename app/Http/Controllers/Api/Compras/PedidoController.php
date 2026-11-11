<?php

namespace App\Http\Controllers\Api\Compras;

use App\Http\Controllers\Controller;
use App\Models\Compras\Pedido;
use App\Http\Requests\Compras\{
    StorePedidoRequest,
    UpdatePedidoRequest
    };
use App\Models\Catalogos\{
    Empresa,
    Estado,
    Gerencia,
    Proyecto,
    TipoCompra,
    TipoPedido,
    Ubicacion
};
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $pedidos = Pedido::with([
            'tipoPedido',
            'gerencia',
            'empresa',
            'proyecto',
            'ubicacion',
            'tipoCompra',
            'estado',
        ])
            ->latest('fecha')
            ->get();

        return response()->json([
            'status' => true,
            'data' => $pedidos,
        ], 200);
    }

    public function vistaIndex()
    {
        $pedidos = Pedido::with([
            'tipoPedido',
            'gerencia',
            'empresa',
            'proyecto',
            'ubicacion',
            'tipoCompra',
            'estado',
        ])
            ->latest('fecha')
            ->get();

        return view(
            'Compras.Pedido.index',
            compact('pedidos')
        );
    }

    public function vistaCreate()
    {
        $tiposPedido = TipoPedido::orderBy('nombre')
            ->get();
        $gerencias = Gerencia::orderBy('nombre')
            ->get();
        $empresas = Empresa::orderBy('nombre')
            ->get();
        $proyectos = Proyecto::orderBy('nombre')
            ->get();
        $ubicaciones = Ubicacion::orderBy('nombre')
            ->get();
        $tiposCompra = TipoCompra::orderBy('nombre')
            ->get();
        $estados = Estado::orderBy('nombre_estado')
            ->get();
        $ultimoNumero = Pedido::withTrashed()
            ->selectRaw(
                "MAX(CAST(SUBSTRING(folio, 5) AS UNSIGNED)) AS ultimo"
            )
            ->value('ultimo');
        $siguienteNumero = ($ultimoNumero ?? 0) + 1;
        $siguienteFolio = 'PED-' . str_pad(
            $siguienteNumero,
            3,
            '0',
            STR_PAD_LEFT
        );
        return view(
            'Compras.Pedido.create',
            compact(
                'tiposPedido',
                'gerencias',
                'empresas',
                'proyectos',
                'ubicaciones',
                'tiposCompra',
                'estados',
                'siguienteFolio'
            )
        );
    }

    public function vistaEdit(Pedido $pedido)
    {
        $tiposPedido = TipoPedido::orderBy('nombre')
            ->get();
        $gerencias = Gerencia::orderBy('nombre')
            ->get();
        $empresas = Empresa::orderBy('nombre')
            ->get();
        $proyectos = Proyecto::orderBy('nombre')
            ->get();
        $ubicaciones = Ubicacion::orderBy('nombre')
            ->get();
        $tiposCompra = TipoCompra::orderBy('nombre')
            ->get();
        $estados = Estado::orderBy('nombre_estado')
            ->get();
        return view(
            'Compras.Pedido.edit',
            compact(
                'pedido',
                'tiposPedido',
                'gerencias',
                'empresas',
                'proyectos',
                'ubicaciones',
                'tiposCompra',
                'estados'
            )
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $pedido = Pedido::all();

        return response()->json([
            'status' => true,
            'data' => $pedido,
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePedidoRequest $request)
    {
        //
        $pedido = Pedido::create($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Pedido registrado correctamente',
            'data' => $pedido
            ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Pedido $pedido)
    {
        //
        return response()->json([
            'status' => true,
            'data' => $pedido,
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pedido $pedido)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePedidoRequest $request, Pedido $pedido)
    {
        //
        $pedido->update($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Pedido actualizado correctamente',
            'data' => $pedido
            ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pedido $pedido)
    {
        //
        $pedido->delete();

        return response()->json([
            'status' => true,
            'message' => 'Pedido eliminado correctamente',
        ], 200);
    }
}
