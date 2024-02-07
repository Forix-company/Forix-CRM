<?php

namespace Modules\Compras\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AutorizacionesCompraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('purchase_authorizations')->insert([
            array(
                'name_authorizations' => 'Autorizado',
                'created_at' => new \Datetime(),
                'updated_at' => new \Datetime(),
            ),
            array(
                'name_authorizations' => 'No Autorizado',
                'created_at' => new \Datetime(),
                'updated_at' => new \Datetime(),
            ),
            ]
        );
    }
}
