<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SolicitudCargaMaximaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \DB::table('solicitud_carga_maxima')->insert([
            [
                'fecha_solicitud' => '2023-11-04',
                'semestre' => '2023A',
                'materias_reprobadas' => 2,
                'duracion_y_media' => 1,
                'fecha_impresion' => '2023-11-04 12:00:00',
                'fecha_hora_tutor' => '2023-11-04 12:30:00',
                'estado_solicitud' => 'Autorizada',
                'clave_unica' => 54789,
                'rpe_tutor' => 12345,
                'rpe_staff' => null,
                'id_sesion_hctc' => null,
            ], 
            [
                'fecha_solicitud' => '2023-11-05',
                'semestre' => '2023B',
                'materias_reprobadas' => 1,
                'duracion_y_media' => 2,
                'fecha_impresion' => '2023-11-05 14:00:00',
                'fecha_hora_tutor' => '2023-11-05 14:30:00',
                'estado_solicitud' => 'Aprobado',
                'clave_unica' => 98765,
                'rpe_tutor' => 12345,
                'rpe_staff' => null,
                'id_sesion_hctc' => null,
            ],
            [
                'fecha_solicitud' => '2023-11-06',
                'semestre' => '2023C',
                'materias_reprobadas' => 3,
                'duracion_y_media' => 1,
                'fecha_impresion' => '2023-11-06 10:00:00',
                'fecha_hora_tutor' => '2023-11-06 10:30:00',
                'estado_solicitud' => 'Rechazado',
                'clave_unica' => 14895,
                'rpe_tutor' => 57643, 
                'rpe_staff' => null,
                'id_sesion_hctc' => null,
            ],
        ]);
    }
}
