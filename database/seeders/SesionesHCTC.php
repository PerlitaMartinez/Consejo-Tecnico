<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SesionesHCTC extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \DB::table('sesion_hctc')->insert([
            [
                'id_sesion_hctc' => 1,
                'fecha_sesion'  => '2020-11-04',
                'tipo_Sesion' => 'Nomal',
            ],
            [
                'id_sesion_hctc' => 2,
                'fecha_sesion'  => '2015-01-04',
                'tipo_Sesion' => 'Extraordinaria',
            ],
            [
                'id_sesion_hctc' => 3,
                'fecha_sesion'  => '2023-11-04',
                'tipo_Sesion' => 'Extraordinaria',
            ],
            [
                'id_sesion_hctc' => 4,
                'fecha_sesion'  => '2023-11-04',
                'tipo_Sesion' => 'Extraordinaria',
            ],
            [
                'id_sesion_hctc' => 5,
                'fecha_sesion'  => '2023-11-04',
                'tipo_Sesion' => 'Extraordinaria',
            ],
            ]);
    }
}
