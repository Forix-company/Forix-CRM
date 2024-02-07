<?php

namespace Modules\Base\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlantillaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('layout_colors')->insert([
            array(
                'color_logo' => 'blue',
                'color_header' => 'blue2',
                'color_sidebar' => 'white',
                'color_body' => 'bg1',
                'created_at' => new \Datetime(),
                'updated_at' => new \Datetime(),
            )]
        );
    }
}
