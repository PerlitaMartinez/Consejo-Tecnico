<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SolicitudMateriaUnicaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \DB::table('solicitud_materia_unica')->insert([
            [
                'fecha_solicitud' => '2023-11-07',
                'semestre' => '2023A',
                'fecha_impresion' => '2023-11-07 09:00:00',
                'fecha_hora_tutor' => '2023-11-07 09:30:00',
                'estado_solicitud' => 'ALTA',
                'clave_unica' => 56487,
                'rpe_tutor' => 12345,
                'rpe_staff' => null,
                'id_sesion_hctc' => null,
                'clave_materia' => 'MAT001', // Cambia esto según tus necesidades
            ],
            [
                'fecha_solicitud' => '2023-11-08',
                'semestre' => '2023B',
                'fecha_impresion' => '2023-11-08 11:00:00',
                'fecha_hora_tutor' => '2023-11-08 11:30:00',
                'estado_solicitud' => 'AUTORIZADA',
                'clave_unica' => 21548,
                'rpe_tutor' => 12345,
                'rpe_staff' => null,
                'id_sesion_hctc' => null,
                'clave_materia' => 'MAT002',
            ],
            [
                'fecha_solicitud' => '2023-11-09',
                'semestre' => '2023C',
                'fecha_impresion' => '2023-11-09 14:00:00',
                'fecha_hora_tutor' => '2023-11-09 14:30:00',
                'estado_solicitud' => 'AUTORIZADA',
                'clave_unica' => 65789,
                'rpe_tutor' => 57643,
                'rpe_staff' => null,
                'id_sesion_hctc' => null,
                'clave_materia' => 'MAT003', 
            ],
        ]);
    }
}
