<?php

namespace Tests\Feature\Controllers;

use App\Http\Controllers\Api\Usuarios\TrabajadorController;
use App\Http\Requests\Usuarios\StoreTrabajadorRequest;
use App\Http\Requests\Usuarios\UpdateTrabajadorRequest;
use App\Models\Usuarios\Trabajador;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class TrabajadorControllerTest extends TestCase
{
    use DatabaseMigrations;

    protected function setUp(): void
    {
        parent::setUp();
        DB::statement('PRAGMA foreign_keys = OFF');
    }

    public function test_index_lists_workers(): void
    {
        Trabajador::query()->create($this->payload());

        $response = app(TrabajadorController::class)->index();

        $this->assertSame(200, $response->getStatusCode());
        $this->assertCount(1, $response->getData()->data);
    }

    public function test_store_creates_worker(): void
    {
        $request = \Mockery::mock(StoreTrabajadorRequest::class);
        $request->shouldReceive('validated')->once()->andReturn($this->payload());

        $response = app(TrabajadorController::class)->store($request);

        $this->assertSame(201, $response->getStatusCode());
        $this->assertDatabaseHas('trabajadors', ['nt' => 'NT-001']);
    }

    public function test_show_update_and_destroy_worker(): void
    {
        $worker = Trabajador::query()->create($this->payload());
        $controller = app(TrabajadorController::class);

        $this->assertSame(200, $controller->show($worker)->getStatusCode());

        $update = \Mockery::mock(UpdateTrabajadorRequest::class);
        $update->shouldReceive('validated')->once()->andReturn(['nombre' => 'Nombre Actualizado']);
        $this->assertSame(200, $controller->update($update, $worker)->getStatusCode());
        $this->assertDatabaseHas('trabajadors', ['id' => $worker->id, 'nombre' => 'Nombre Actualizado']);

        $this->assertSame(200, $controller->destroy($worker)->getStatusCode());
        $this->assertSoftDeleted('trabajadors', ['id' => $worker->id]);
    }

    private function payload(): array
    {
        return [
            'nt' => 'NT-001',
            'nombre' => 'Juan',
            'apellido_paterno' => 'Perez',
            'apellido_materno' => 'Lopez',
            'sexo' => 'Hombre',
            'nss' => '12345678901',
            'curp' => 'PELJ900101HDFXXX01',
            'rfc' => 'PELJ900101ABC',
            'fecha_nacimiento' => '1990-01-01',
            'lugar_nacimiento_id' => 1,
            'tipo_sangre_id' => 1,
        ];
    }
}
