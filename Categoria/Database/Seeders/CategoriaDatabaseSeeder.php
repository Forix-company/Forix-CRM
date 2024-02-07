<?php

namespace Modules\Categoria\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Categoria\Entities\Categoria;

class CategoriaDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Categoria::insert([
            array(
                'name_category' => 'Celulares',
                'description_category' => 'celulares example',
                'created_at' => new \Datetime(),
                'updated_at' => new \Datetime(),
            )
            ]
        );
    }
}
