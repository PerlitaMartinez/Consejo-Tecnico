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

        //Obtenemos todas las  solicitudes de Materia Única
        $dataMaterias = $this->fetchMateriaUnica($dataSet[0]['clave_unica']);

        //Obtenemos todas las solicitudes de Carga Máxima
        $dataCargaMaxima = $this->fetchCargaMaxima($dataSet[0]['clave_unica']);

        //Obtenemos todas las solicitudes de opción titulación
        $dataOpcionTitulacion = $this->fetchOpcionTitulacion($dataSet[0]['clave_unica']);


        //Regresamos la vista
        return view('seguimiento', ['dataSet' => $dataSet, 'mu_info' =>  $dataMaterias, 'cm_info' => $dataCargaMaxima, 'ot_info' =>  $dataOpcionTitulacion]);
    }


    public function fetchMateriaUnica($clave_Unica)
    {
        $materias = MateriaUnicaModel::select('id_solicitud_mu', 'clave_materia', 'semestre')
            ->where('clave_unica', $clave_Unica)
            ->get();

        if ($materias->isEmpty()) { //El alumno no tiene ninguna materia única registrada
            return null;
        }

        $infoMaterias = $this->procesaInfo($materias);

        return  $infoMaterias;
    }


    //Ya que en la base de datos no se guarda el nombre de la materia única, hay que obtener el nombre de la materia del servicio web.
    private function procesaInfo($dataMaterias)
    {

        //----Cuando se tenga disponible, se manda llamar al servicio web.---------

        foreach ($dataMaterias as $data) {
            $fila = [
                'id_solicitud_mu' => $data->id_solicitud_mu,
                'materia' => $this->fetchNombreMateria($data->clave_materia),
                'semestre' => $data->semestre,
            ];
            $dataSet[] = $fila;
        }
        
        return $dataSet;
    }


    //Reestructurar esta función cuando se tenga el servicio web.
    private function fetchNombreMateria($clave_materia)
    {
        $encontrado = false;
        for ($i = 0; $i < count($this->materias) && !$encontrado; $i++) {
            if ($this->materias[$i]['cve_materia'] == $clave_materia) {
                $encontrado = true;
                $nombre_materia = $this->materias[$i]['nombre_materia'];
            }
        }

        if(!isset($nombre_materia))
            return "CALCULO A";

        return $nombre_materia;
    }


    //Método que envía todas las solicitudes de carga máxima de un alumno.
    private function fetchCargaMaxima($clave_Unica)
    {
        $solicitud = CargaMaximaModel::select('id_solicitud_cm', 'materias_reprobadas', 'duracion_y_media', 'semestre')
            ->where('clave_unica', $clave_Unica)
            ->get();

        if ($solicitud->isEmpty()) { //El alumno no tiene niguna solicitud de carga máxima registrada.
            return null;
        }

        return $solicitud;
    }


    private function fetchOpcionTitulacion($clave_Unica){
        $resultados = $resultados = DB::table('solicitud_opcion_titulacion as OT')
        ->select('OT.id_solicitud_OT', 'COT.opcion_titulacion', 'OT.semestre')
        ->join('cat_opcion_titulacion as COT', 'OT.id_opcion_titulacion', '=', 'COT.id_opcion_titulacion')
        ->where('OT.clave_unica', $clave_Unica)
        ->get();
        
        //dd($resultados);
        if ($resultados->isEmpty()) {
            return null;
        }

        return $resultados;

    }
}
