<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DistribuidoresSeeder extends Seeder
{
    public function run()
    {
        DB::table('distribuidores')->insert([
            ['nombre_distri' => 'Cofarma'],
            ['nombre_distri' => 'Empsephar'],
            ['nombre_distri' => 'Cemefar'],
        ]);
    }
}
