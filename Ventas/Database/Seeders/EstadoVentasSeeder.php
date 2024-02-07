<?php

namespace Modules\Ventas\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EstadoVentasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sales_state')->insert([
            array(
                'name_state' => 'Activo',
                'created_at' => new \Datetime(),
                'updated_at' => new \Datetime(),
            ),
            array(
                'name_state' => 'Suspendido',
                'created_at' => new \Datetime(),
                'updated_at' => new \Datetime(),
            ),
            array(
                'name_state' => 'Cancelado',
                'created_at' => new \Datetime(),
                'updated_at' => new \Datetime(),
            )
            ]
        );
    }
}
