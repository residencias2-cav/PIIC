<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            LugarSeeder::class,
            ObraSeeder::class,
            GerenciaSeeder::class,
            EmpresaSeeder::class,
            EstadoSeeder::class,
            TipoCompraSeeder::class,
            TipoPedidoSeeder::class,
            UbicacionSeeder::class,
            UnidadSeeder::class,
            ProyectoSeeder::class,
            TipoServicioSeeder::class,
            ProductoServicioSeeder::class,
            EstadoPedidoSeeder::class,
            TipoCotizacionSeeder::class,
            LugarNacimientoSeeder::class,
            ArticuloSeeder::class,
            ContratoSeeder::class,
            TipoSangreSeeder::class,
            TipoUsuarioSeeder::class,
            TipoOficioSeeder::class,
            InfCreditoSeeder::class,
            TipoEppSeeder::class,
            InfContratoSeeder::class,
        ]);
    }
}
