<?php

namespace Modules\Base\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Compras\Database\Seeders\AutorizacionesCompraSeeder;
use Modules\Compras\Database\Seeders\ComprobanteCompraSeeder;
use Modules\Compras\Database\Seeders\EstadoCompraSeeder;
use Modules\Inventario\Database\Seeders\EstadoInventarioSeeder;
use Modules\Pasarela\Database\Seeders\MetodoPagoSeeder;
use Modules\Productos\Database\Seeders\EstadoProductosSeeder;
use Modules\Ventas\Database\Seeders\ComprobanteVentasSeeder;
use Modules\Ventas\Database\Seeders\EstadoVentasSeeder;

class BaseDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       // Model::unguard();

        $this->call(MetodoPagoSeeder::class);
        $this->call(EstadoVentasSeeder::class);
        $this->call(EstadoProductosSeeder::class);
        $this->call(EstadoInventarioSeeder::class);
        $this->call(EstadoCompraSeeder::class);
        $this->call(AutorizacionesCompraSeeder::class);
        $this->call(ComprobanteVentasSeeder::class);
        $this->call(ComprobanteCompraSeeder::class);
        $this->call(PlantillaTableSeeder::class);

        // $this->call("OthersTableSeeder");
    }
}
