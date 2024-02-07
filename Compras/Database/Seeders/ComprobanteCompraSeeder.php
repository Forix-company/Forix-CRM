<?php

namespace Modules\Compras\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ComprobanteCompraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('purchase_receipt')->insert([
            array(
                'voucher_name' => 'Orden de Compra',
                'created_at' => new \Datetime(),
                'updated_at' => new \Datetime(),
            )
        ]);
    }
}
