<?php

namespace Modules\Inventario\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EstadoInventarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('inventory_state')->insert(
            [
                array(
                    'name_state_inventory' => 'Autorizar',
                    'created_at' => new \Datetime(),
                    'updated_at' => new \Datetime(),
                ),
                array(
                    'name_state_inventory' => 'No Autorizar',
                    'created_at' => new \Datetime(),
                    'updated_at' => new \Datetime(),
                ),
                array(
                    'name_state_inventory' => 'Devolucion Por Garantia',
                    'created_at' => new \Datetime(),
                    'updated_at' => new \Datetime(),
                ),
                array(
                    'name_state_inventory' => 'Entrega de Nuevos Productos por Garantia',
                    'created_at' => new \Datetime(),
                    'updated_at' => new \Datetime(),
                )
            ]
        );
    }
}
