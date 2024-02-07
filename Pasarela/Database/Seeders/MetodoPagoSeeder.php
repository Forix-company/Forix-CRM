<?php

namespace Modules\Pasarela\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class MetodoPagoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('Payment_Method')->insert([
            array(
                'PaymentMethod' => 'Pago en efectivo',
                'created_at' => new \Datetime(),
                'updated_at' => new \Datetime(),
            ),
            array(
                'PaymentMethod' => 'PSE (Pago Seguro en Línea)',
                'created_at' => new \Datetime(),
                'updated_at' => new \Datetime(),
            ),
        ]);
    }
}
