<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SucursalesSeeder extends Seeder
{
    public function run()
    {
        DB::table('sucursales')->insert([
            ['nombre_sucur' => 'Principal', 'direccion_sucur' => 'Calle de la Rosa n. 28'],
            ['nombre_sucur' => 'Secundaria', 'direccion_sucur' => 'Calle Alcazabilla n. 3'],
        ]);        
    }
}
