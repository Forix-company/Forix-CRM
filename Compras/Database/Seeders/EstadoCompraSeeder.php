<?php

namespace Modules\Compras\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EstadoCompraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('state_buys')->insert(
            [
                array(
                    'name_state_buys' => 'Activo',
                    'created_at' => new \Datetime(),
                    'updated_at' => new \Datetime(),
                ),
                array(
                    'name_state_buys' => 'Suspendido',
                    'created_at' => new \Datetime(),
                    'updated_at' => new \Datetime(),
                ),
                array(
                    'name_state_buys' => 'Cancelado',
                    'created_at' => new \Datetime(),
                    'updated_at' => new \Datetime(),
                )
            ]
        );
    }
}
