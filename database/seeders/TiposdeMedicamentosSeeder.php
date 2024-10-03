<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TiposdeMedicamentosSeeder extends Seeder
{
    public function run()
    {
        // insertamos los tipos de medicamentos a la base
        DB::table('tipos_medicamentos')->insert([
            ['nombre_tipo' => 'Analgésico'],
            ['nombre_tipo' => 'Analéptico'],
            ['nombre_tipo' => 'Anestésico'],
            ['nombre_tipo' => 'Antiácido'],
            ['nombre_tipo' => 'Antidepresivo'],
            ['nombre_tipo' => 'Antibiótico'],
        ]);
    }
}
