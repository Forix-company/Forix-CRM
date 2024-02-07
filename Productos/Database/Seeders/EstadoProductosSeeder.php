<?php

namespace Modules\Productos\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EstadoProductosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('state_products')->insert([
            array(
                'name_state_products' => 'Activo',
                'created_at' => new \Datetime(),
                'updated_at' => new \Datetime(),
            ),
            array(
                'name_state_products' => 'Suspendido',
                'created_at' => new \Datetime(),
                'updated_at' => new \Datetime(),
            ),
            array(
                'name_state_products' => 'Cancelado',
                'created_at' => new \Datetime(),
                'updated_at' => new \Datetime(),
            )
            ]
        );
    }
}
