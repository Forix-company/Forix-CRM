<?php

namespace Modules\Etiquetas\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Etiquetas\Entities\Etiquetas;
class EtiquetasDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Etiquetas::insert([
            array(
                'name_tags' => 'Celulares',
                'description_tags' => 'celulares example',
                'created_at' => new \Datetime(),
                'updated_at' => new \Datetime(),
            )
            ]
        );

    }
}
