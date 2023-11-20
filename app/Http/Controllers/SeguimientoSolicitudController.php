<?php

namespace App\Http\Controllers;

use App\Models\CargaMaximaModel;
use App\Models\CatOpcionTitulacionModel;
use App\Models\MateriaUnicaModel;
use App\Models\OpcionTitulacionModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SeguimientoSolicitudController extends Controller
{
    protected $materias = [
        [
            "clave_unica" => 39999,
            "nombre_materia" => "CALCULO A",
            "cve_materia" => "2865",
            "semestre" => '2018-2019/II',
        ],
        [
            "clave_unica" => 39999,
            "nombre_materia" => "BASE DE DATOS",
            "cve_materia" => "3622",
            "semestre" => '2020-2021/II',
        ],
        [
            "clave_unica" => 39999,
            "nombre_materia" => "ESTRUCTURAS DE DATOS II",
            "cve_materia" => "9125",
            "semestre" => "2023-2024/I",
        ],

    ];

    public function SeguimientoShow(Request $request)
    {
        //dataSet del Servicio web
        $dataSet = $request->input('dataSet');
        if (gettype($dataSet) === 'string') {
            $dataSet = json_decode($request->input('dataSet'), true);
        }

        $materiaUnica = new MateriaUnicaController();

        //Obtenemos todas las  solicitudes de Materia Única
        $dataMaterias = $materiaUnica->fetchMateriaUnicaClave($dataSet[0]['clave_unica'], 'ALUMNOS');

        $cargaMaxima = new CargaMaximaController();

        //Obtenemos todas las solicitudes de Carga Máxima
        $dataCargaMaxima = $cargaMaxima->fetchCargaMaxima($dataSet[0]['clave_unica'], 'ALUMNOS');


        $opTitulacion = new OpcionTitulacionController();
        //Obtenemos todas las solicitudes de opción titulación
        $dataOpcionTitulacion = $opTitulacion->fetchOpcionTitulacion($dataSet[0]['clave_unica'], 'ALUMNOS');


        //Regresamos la vista
        return view('seguimiento', ['dataSet' => $dataSet, 'mu_info' =>  $dataMaterias, 'cm_info' => $dataCargaMaxima, 'ot_info' =>  $dataOpcionTitulacion]);
    }
}
