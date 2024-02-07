<?php

namespace Modules\Fabricante\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Fabricante\Entities\Fabricantes;

class FabricanteDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Fabricantes::insert([
            array(
                'name_manufacturer' => 'samsung',
                'created_at' => new \Datetime(),
                'updated_at' => new \Datetime(),
            )
            ]
        );

        // $this->call("OthersTableSeeder");
    }
}
