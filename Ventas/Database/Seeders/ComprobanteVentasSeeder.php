<?php

namespace Modules\Ventas\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ComprobanteVentasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sales_receipt')->insert([
            array(
                'name_receipt' => 'Orden de Venta',
                'created_at' => new \Datetime(),
                'updated_at' => new \Datetime(),
            )
        ]);
    }
}
