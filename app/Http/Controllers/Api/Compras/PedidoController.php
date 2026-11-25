<?php
namespace App\Http\Controllers\Api\Compras;

use App\Enums\EstadoSolicitudPedido;
use App\Models\Usuarios\Usuario;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Gate;
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
    TipoServicio,
    Ubicacion,
    Unidad
};
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PedidoController extends Controller
{
    /**
     * Mostrar todos los pedidos mediante API.
     */
    /**
 * Mostrar pedidos mediante API.
 */
    public function index(): JsonResponse
    {
        Gate::authorize(
            'viewAny',
            Pedido::class
        );

        $pedidos = $this
            ->consultaPedidosPermitidos()
            ->with([
                'tipoPedido',
                'gerencia',
                'empresa',
                'proyecto',
                'ubicacion',
                'tipoCompra',
                'estado',
                'pedidosInternos',
                'detallesPedido',
            ])
            ->latest('fecha')
            ->get();

        return response()->json([
            'status' => true,
            'data' => $pedidos,
        ], 200);
    }

    /**
     * Mostrar la vista principal de pedidos.
     */
    /**
 * Mostrar la vista principal de pedidos.
 */
    public function vistaIndex()
    {
        Gate::authorize(
            'viewAny',
            Pedido::class
        );

        $pedidos = $this
            ->consultaPedidosPermitidos()
            ->with([
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

    /**
     * Mostrar formulario de registro.
     */
    public function vistaCreate()
    {
        Gate::authorize(
            'create',
            Pedido::class
        );

        /** @var Usuario $usuario */
        $usuario = Auth::user();

        $tiposPedido = TipoPedido::orderBy('nombre')->get();

        /*
        * Sólo se envía al formulario la gerencia
        * del usuario autenticado.
        */
        $gerencias = Gerencia::whereKey(
            $usuario->gerencia_id
        )->get();

        $empresas = Empresa::orderBy('nombre')->get();

        $proyectos = Proyecto::orderBy('nombre')->get();

        $ubicaciones = Ubicacion::orderBy('nombre')->get();

        $tiposCompra = TipoCompra::orderBy('nombre')->get();

        $estados = Estado::orderBy(
            'nombre_estado'
        )->get();

        $unidades = Unidad::orderBy('nombre')->get();

        $tiposServicio = TipoServicio::orderBy(
            'nombre'
        )->get();

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
                'unidades',
                'tiposServicio',
                'siguienteFolio'
            )
        );
    }

    /**
     * Mostrar formulario de edición.
     */
    /**
 * Mostrar formulario de edición.
 */
    public function vistaEdit(Pedido $pedido)
    {
        Gate::authorize(
            'update',
            $pedido
        );

        $tiposPedido = TipoPedido::orderBy('nombre')->get();

        $gerencias = Gerencia::whereKey(
            Auth::user()->gerencia_id
        )->get();

        $empresas = Empresa::orderBy('nombre')->get();

        $proyectos = Proyecto::orderBy('nombre')->get();

        $ubicaciones = Ubicacion::orderBy('nombre')->get();

        $tiposCompra = TipoCompra::orderBy('nombre')->get();

        $estados = Estado::orderBy(
            'nombre_estado'
        )->get();

        $unidades = Unidad::orderBy('nombre')->get();

        $tiposServicio = TipoServicio::orderBy(
            'nombre'
        )->get();

        $pedido->load([
            'tipoPedido',
            'gerencia',
            'empresa',
            'proyecto',
            'ubicacion',
            'tipoCompra',
            'estado',
            'pedidosInternos',
            'detallesPedido',
        ]);

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
                'estados',
                'unidades',
                'tiposServicio'
            )
        );
    }

    /**
     * Mostrar los pedidos mediante API.
     */
    public function create(): JsonResponse
    {
        Gate::authorize(
            'create',
            Pedido::class
        );

        /** @var Usuario $usuario */
        $usuario = Auth::user();

        return response()->json([
            'status' => true,
            'data' => [
                'tipos_pedido' =>
                    TipoPedido::orderBy('nombre')->get(),

                'gerencia' =>
                    Gerencia::findOrFail(
                        $usuario->gerencia_id
                    ),

                'empresas' =>
                    Empresa::orderBy('nombre')->get(),

                'proyectos' =>
                    Proyecto::orderBy('nombre')->get(),

                'ubicaciones' =>
                    Ubicacion::orderBy('nombre')->get(),

                'tipos_compra' =>
                    TipoCompra::orderBy('nombre')->get(),

                'estados' =>
                    Estado::orderBy('nombre_estado')->get(),

                'unidades' =>
                    Unidad::orderBy('nombre')->get(),

                'tipos_servicio' =>
                    TipoServicio::orderBy('nombre')->get(),
            ],
        ], 200);
    }

    /**
     * Registrar un pedido.
     *
     * Pedido general:
     * Guarda únicamente en pedidos.
     *
     * Pedido interno:
     * Guarda en pedidos y pedido_internos.
     *
     * Pedido ALM:
     * Guarda en pedidos y detalle_pedidos.
     */
    /**
 * Registrar un pedido.
 */
    public function store(StorePedidoRequest $request)
    {
        Gate::authorize(
            'create',
            Pedido::class
        );

        /** @var Usuario $usuario */
        $usuario = Auth::user();

        $pedido = DB::transaction(
            function () use ($request, $usuario) {

                $datos = $request->validated();

                $pedidoInterno =
                    $datos['pedido_interno'] ?? null;

                $detalles =
                    $datos['detalles'] ?? null;

                unset(
                    $datos['pedido_interno'],
                    $datos['detalles']
                );

                /*
                * Estos datos no se confían al formulario.
                */
                $datos['created_by'] = $usuario->id;

                $datos['gerencia_id'] =
                    $usuario->gerencia_id;

                $datos['estado_solicitud'] =
                    EstadoSolicitudPedido::BORRADOR;

                $pedido = Pedido::create($datos);

                if ($pedidoInterno !== null) {
                    $pedido->pedidosInternos()->create(
                        $pedidoInterno
                    );
                }

                if ($detalles !== null) {
                    foreach ($detalles as $detalle) {
                        $pedido->detallesPedido()->create(
                            $detalle
                        );
                    }
                }

                return $pedido;
            }
        );

        $pedido->load([
            'tipoPedido',
            'gerencia',
            'empresa',
            'proyecto',
            'ubicacion',
            'tipoCompra',
            'estado',
            'pedidosInternos',
            'detallesPedido',
        ]);

        if ($request->expectsJson()) {
            return response()->json([
                'status' => true,
                'message' =>
                    'Pedido registrado correctamente.',
                'data' => $pedido,
            ], 201);
        }

        return redirect()
            ->route('pedido.index')
            ->with(
                'success',
                'Pedido registrado correctamente.'
            );
    }

    /**
     * Mostrar un pedido específico.
     */
    /**
 * Mostrar un pedido específico.
 */
    public function show(Pedido $pedido): JsonResponse
    {
        Gate::authorize(
            'view',
            $pedido
        );

        $pedido->load([
            'tipoPedido',
            'gerencia',
            'empresa',
            'proyecto',
            'ubicacion',
            'tipoCompra',
            'estado',
            'pedidosInternos',
            'detallesPedido',
        ]);

        return response()->json([
            'status' => true,
            'data' => $pedido,
        ], 200);
    }

    /**
     * Mostrar formulario de edición.
     */
    /**
 * Obtener un pedido para edición mediante API.
 */
    public function edit(Pedido $pedido): JsonResponse
    {
        Gate::authorize(
            'update',
            $pedido
        );

        return response()->json([
            'status' => true,
            'data' => $pedido->load([
                'tipoPedido',
                'gerencia',
                'empresa',
                'proyecto',
                'ubicacion',
                'tipoCompra',
                'estado',
                'pedidosInternos',
                'detallesPedido',
            ]),
        ], 200);
    }

    /**
     * Actualizar un pedido.
     */
    /**
 * Actualizar un pedido.
 */
    public function update(
        UpdatePedidoRequest $request,
        Pedido $pedido
    ) {
        Gate::authorize(
            'update',
            $pedido
        );

        $datos = $request->validated();

        /*
        * No se permite modificar estos campos
        * mediante la operación CRUD normal.
        */
        unset(
            $datos['created_by'],
            $datos['gerencia_id'],
            $datos['estado_solicitud']
        );

        $pedido->update($datos);

        if ($request->expectsJson()) {
            return response()->json([
                'status' => true,
                'message' =>
                    'Pedido actualizado correctamente.',
                'data' => $pedido->fresh(),
            ], 200);
        }

        return redirect()
            ->route('pedido.index')
            ->with(
                'success',
                'Pedido actualizado correctamente.'
            );
    }

    /**
     * Eliminar un pedido.
     */
    /**
 * Eliminar un pedido.
 */
    public function destroy(
        Request $request,
        Pedido $pedido
    ) {
        Gate::authorize(
            'delete',
            $pedido
        );

        $pedido->delete();

        if ($request->expectsJson()) {
            return response()->json([
                'status' => true,
                'message' =>
                    'Pedido eliminado correctamente.',
            ], 200);
        }

        return redirect()
            ->route('pedido.index')
            ->with(
                'success',
                'Pedido eliminado correctamente.'
            );
    }

    /**
 * Construye la consulta de pedidos visibles
 * para el usuario autenticado.
 */
    private function consultaPedidosPermitidos(): Builder
    {
        /** @var Usuario $usuario */
        $usuario = Auth::user();

        $consulta = Pedido::query();

        if ($usuario->esAdmin() || $usuario->esSubDirector()) {
            return $consulta;
        }

        if ($usuario->esSupervisor()) {
            return $consulta->creadosPor($usuario);
        }

        if ($usuario->esGerente()) {
            return $consulta->deGerencia($usuario);
        }

        if ($usuario->esCompras()) {
            return $consulta->where(
                'estado_solicitud',
                EstadoSolicitudPedido::ENVIADO_COMPRAS->value
            );
        }

        abort(403, 'No tienes permiso para consultar pedidos.');
    }
}