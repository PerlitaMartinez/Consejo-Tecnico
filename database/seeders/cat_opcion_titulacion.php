<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class cat_opcion_titulacion extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \DB::table('cat_opcion_titulacion')->insert([
            [
                'opcion_titulacion'=>'Trabajo Recepcional',
            ],
            [
                'opcion_titulacion'=>'Tesis',
            ],
            [
                'opcion_titulacion'=>'Examen Colectivo',
            ],
            [
                'opcion_titulacion'=>'Exención de Exammen por Promedio',
            ],
            [
                'opcion_titulacion'=>'Mediante un semestre o dos cuatrimestres en Estudios de Especialidad o Posgrado',
            ],
            [
                'opcion_titulacion'=>'Examen de Conocimientos con Duración de 8 horas',
            ],
            [
                'opcion_titulacion'=>'Memorias de Actividad Profesional',
            ],
            [
                'opcion_titulacion'=>'Opción a No trabajo Recepcional',
            ],
            [
                'opcion_titulacion'=>'Examen General de Egreso de la Licenciatura',
            ],
            [
                'opcion_titulacion'=>'Mediante dos semestres o tres cuatrimestres en Estudios de Especialidad o Posgrado',
            ],
        ]);
    }
}
