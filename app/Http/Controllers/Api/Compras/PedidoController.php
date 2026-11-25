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
    public function vistaEdit(Pedido $pedido)
    {
        $tiposPedido = TipoPedido::orderBy('nombre')->get();
        $gerencias = Gerencia::orderBy('nombre')->get();
        $empresas = Empresa::orderBy('nombre')->get();
        $proyectos = Proyecto::orderBy('nombre')->get();
        $ubicaciones = Ubicacion::orderBy('nombre')->get();
        $tiposCompra = TipoCompra::orderBy('nombre')->get();
        $estados = Estado::orderBy('nombre_estado')->get();

        // Catálogo de unidades: tabla unidads.
        $unidades = Unidad::orderBy('nombre')->get();

        // Catálogo de tipos de servicio.
        $tiposServicio = TipoServicio::orderBy('nombre')->get();

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
    public function create()
    {
        $pedido = Pedido::all();

        return response()->json([
            'status' => true,
            'data' => $pedido,
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
    public function store(StorePedidoRequest $request)
    {
        $pedido = DB::transaction(function () use ($request) {

            // Obtener únicamente los datos validados.
            $datos = $request->validated();

            // Separar los datos del pedido principal.
            $pedidoInterno = $datos['pedido_interno'] ?? null;
            $detalles = $datos['detalles'] ?? null;

            // Evitar que los datos secundarios lleguen
            // directamente al modelo Pedido.
            unset(
                $datos['pedido_interno'],
                $datos['detalles']
            );

            // Registrar quién creó el pedido.
            $datos['created_by'] = Auth::id();

            // Crear el pedido principal.
            $pedido = Pedido::create($datos);

            // =====================================
            // GUARDAR PEDIDO INTERNO
            // =====================================

            if ($pedidoInterno !== null) {

                $pedido->pedidosInternos()->create(
                    $pedidoInterno
                );
            }

            // =====================================
            // GUARDAR DETALLES DEL PEDIDO ALM
            // =====================================

            if ($detalles !== null) {

                foreach ($detalles as $detalle) {

                    $pedido->detallesPedido()->create(
                        $detalle
                    );
                }
            }

            return $pedido;
        });

        // Cargar relaciones para la respuesta.
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

        // Respuesta para solicitudes API.
        if ($request->expectsJson()) {

            return response()->json([
                'status' => true,
                'message' => 'Pedido registrado correctamente.',
                'data' => $pedido,
            ], 201);
        }

        // Respuesta para el formulario web.
        return redirect()
            ->route('pedido.index')
            ->with('success', 'Pedido registrado correctamente.');
    }

    /**
     * Mostrar un pedido específico.
     */
    public function show(Pedido $pedido)
    {
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
    public function edit(Pedido $pedido)
    {
        //
    }

    /**
     * Actualizar un pedido.
     */
    public function update(
        UpdatePedidoRequest $request,
        Pedido $pedido
    ) {
        $pedido->update($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Pedido actualizado correctamente',
            'data' => $pedido
        ], 200);
    }

    /**
     * Eliminar un pedido.
     */
    public function destroy(Pedido $pedido)
    {
        $pedido->delete();

        return response()->json([
            'status' => true,
            'message' => 'Pedido eliminado correctamente',
        ], 200);
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