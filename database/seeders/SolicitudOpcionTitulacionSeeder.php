<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SolicitudOpcionTitulacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('solicitud_opcion_titulacion')->insert([
            [
                'fecha_solicitud' => '2023-11-14',
                'semestre' => '2023A',
                'fecha_hora_coordinador' => '2023-11-14 10:00:00',
                'fecha_impresion' => '2023-11-14 10:30:00',
                'estado_solicitud' => 'ETREGADA',
                'clave_unica' => rand(10000, 99999), // Clave única de 5 dígitos
                'rpe_staff' => 12345,
                'rpe_coordinador' => 12345,
                'id_opcion_titulacion' => 1, // Cambia esto según tus necesidades
                'id_sesion_hctc' => null,
            ],
            [
                'fecha_solicitud' => '2023-11-15',
                'semestre' => '2023B',
                'fecha_hora_coordinador' => '2023-11-15 12:00:00',
                'fecha_impresion' => '2023-11-15 12:30:00',
                'estado_solicitud' => 'ALTA',
                'clave_unica' => rand(10000, 99999), // Clave única de 5 dígitos
                'rpe_staff' => 12345,
                'rpe_coordinador' => 12345,
                'id_opcion_titulacion' => 2, // Cambia esto según tus necesidades
                'id_sesion_hctc' => null,
            ],
            [
                'fecha_solicitud' => '2023-11-16',
                'semestre' => '2023C',
                'fecha_hora_coordinador' => '2023-11-16 15:00:00',
                'fecha_impresion' => '2023-11-16 15:30:00',
                'estado_solicitud' => 'RESPUESTA',
                'clave_unica' => rand(10000, 99999), // Clave única de 5 dígitos
                'rpe_staff' => 57643, // Otro RPE
                'rpe_coordinador' => 57643,
                'id_opcion_titulacion' => 3, // Cambia esto según tus necesidades
                'id_sesion_hctc' => null,
            ],
        ]);
    }
}
