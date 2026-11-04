<?php

namespace Tests\Feature\Controllers;

use App\Http\Controllers\PedidoController;
use App\Http\Requests\Compras\StorePedidoRequest;
use App\Http\Requests\Compras\UpdatePedidoRequest;
use App\Models\Compras\Pedido;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class PedidoControllerTest extends TestCase
{
    use DatabaseMigrations;

    protected function setUp(): void
    {
        parent::setUp();
        require_once app_path('Http/Controllers/Api/Compras/PedidoController.php');
        DB::statement('PRAGMA foreign_keys = OFF');
    }

    public function test_index_lists_orders(): void
    {
        $order = $this->createOrder();

        $response = app(PedidoController::class)->index();

        $this->assertSame(200, $response->getStatusCode());
        $this->assertCount(1, $response->getData()->data);
        $this->assertDatabaseHas('pedidos', ['id' => $order->id]);
    }

    public function test_show_update_and_destroy_order(): void
    {
        $order = $this->createOrder();
        $controller = app(PedidoController::class);

        $this->assertSame(200, $controller->show($order)->getStatusCode());

        $update = \Mockery::mock(UpdatePedidoRequest::class);
        $update->shouldReceive('all')->once()->andReturn(['observaciones' => 'Actualizadas']);
        $this->assertSame(200, $controller->update($update, $order)->getStatusCode());
        $this->assertDatabaseHas('pedidos', ['id' => $order->id, 'observaciones' => 'Actualizadas']);

        $this->assertSame(200, $controller->destroy($order)->getStatusCode());
        $this->assertSoftDeleted('pedidos', ['id' => $order->id]);
    }

    private function createOrder(): Pedido
    {
        DB::table('pedidos')->insert([
            'fecha' => '2026-11-04',
            'folio' => 'PED-TEST-001',
            'tipo_pedido_id' => 1,
            'gerencia_id' => 1,
            'empresa_id' => 1,
            'proyecto_id' => 1,
            'ubicacion_id' => 1,
            'tipo_compra_id' => 1,
            'estado_id' => 1,
            'observaciones' => 'Prueba',
            'monto_credito' => 1000,
            'monto' => 1500,
            'creayed_by' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return Pedido::query()->where('folio', 'PED-TEST-001')->firstOrFail();
    }
}
