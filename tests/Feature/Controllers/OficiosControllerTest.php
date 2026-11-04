<?php

namespace Tests\Feature\Controllers;

use App\Http\Controllers\Api\Oficios\OficiosController;
use App\Http\Requests\Oficios\StoreOficiosRequest;
use App\Http\Requests\Oficios\UpdateOficiosRequest;
use App\Models\Oficios\Oficios;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class OficiosControllerTest extends TestCase
{
    use DatabaseMigrations;

    protected function setUp(): void
    {
        parent::setUp();
        DB::statement('PRAGMA foreign_keys = OFF');
    }

    public function test_index_lists_offices(): void
    {
        Oficios::query()->create($this->payload());

        $response = app(OficiosController::class)->index();

        $this->assertSame(200, $response->getStatusCode());
        $this->assertCount(1, $response->getData()->data);
    }

    public function test_store_creates_office(): void
    {
        $request = \Mockery::mock(StoreOficiosRequest::class);
        $request->shouldReceive('all')->once()->andReturn($this->payload());

        $response = app(OficiosController::class)->store($request);

        $this->assertSame(201, $response->getStatusCode());
        $this->assertDatabaseHas('oficios', ['folio' => 'OFI-TEST-001']);
    }

    public function test_show_update_and_destroy_office(): void
    {
        $office = Oficios::query()->create($this->payload());
        $controller = app(OficiosController::class);

        $this->assertSame(200, $controller->show($office)->getStatusCode());

        $update = \Mockery::mock(UpdateOficiosRequest::class);
        $update->shouldReceive('all')->once()->andReturn(['observaciones' => 'Actualizadas']);
        $this->assertSame(200, $controller->update($update, $office)->getStatusCode());
        $this->assertDatabaseHas('oficios', ['id' => $office->id, 'observaciones' => 'Actualizadas']);

        $this->assertSame(200, $controller->destroy($office)->getStatusCode());
        $this->assertDatabaseMissing('oficios', ['id' => $office->id]);
    }

    private function payload(): array
    {
        return [
            'folio' => 'OFI-TEST-001',
            'fecha' => '2026-11-04',
            'asunto' => 'Asunto de prueba',
            'cuerpo' => 'Cuerpo del oficio',
            'tipo_oficio_id' => 1,
            'estado_id' => 1,
            'observaciones' => 'Prueba',
            'cargos_generales' => 'Director',
        ];
    }
}
