<?php

namespace Tests\Feature\Controllers;

use App\Http\Controllers\Api\Epp\InventarioEppController;
use App\Http\Requests\Epp\StoreInventarioEppRequest;
use App\Http\Requests\Epp\UpdateInventarioEppRequest;
use App\Models\Epp\InventarioEpp;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class InventarioEppControllerTest extends TestCase
{
    use DatabaseMigrations;

    protected function setUp(): void
    {
        parent::setUp();
        DB::statement('PRAGMA foreign_keys = OFF');
    }

    public function test_index_lists_inventory(): void
    {
        InventarioEpp::query()->create($this->payload());

        $response = app(InventarioEppController::class)->index();

        $this->assertSame(200, $response->getStatusCode());
        $this->assertCount(1, $response->getData()->data);
    }

    public function test_store_creates_inventory_item(): void
    {
        $request = \Mockery::mock(StoreInventarioEppRequest::class);
        $request->shouldReceive('validated')->once()->andReturn($this->payload());

        $response = app(InventarioEppController::class)->store($request);

        $this->assertSame(201, $response->getStatusCode());
        $this->assertDatabaseHas('inventario_epps', ['articulo_id' => 1, 'talla' => 32, 'existencia' => 10]);
    }

    public function test_show_update_and_destroy_inventory_item(): void
    {
        $item = InventarioEpp::query()->create($this->payload());
        $controller = app(InventarioEppController::class);

        $this->assertSame(200, $controller->show($item)->getStatusCode());

        $update = \Mockery::mock(UpdateInventarioEppRequest::class);
        $update->shouldReceive('validated')->once()->andReturn(['existencia' => 25]);
        $this->assertSame(200, $controller->update($update, $item)->getStatusCode());
        $this->assertDatabaseHas('inventario_epps', ['id' => $item->id, 'existencia' => 25]);

        $this->assertSame(200, $controller->destroy($item)->getStatusCode());
        $this->assertDatabaseMissing('inventario_epps', ['id' => $item->id]);
    }

    private function payload(): array
    {
        return ['articulo_id' => 1, 'talla' => 32, 'existencia' => 10];
    }
}
