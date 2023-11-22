<?php

namespace App\Http\Controllers;

use App\Helpers\WebService;
use Illuminate\Http\Request;

class WebServiceController extends Controller
{

    //Método del servicio web "validaAlumno"
    public function validaAlumno(Request $request)
    {
        $clave = $request->input("clave_unica");
        $contrasena = $request->input("contrasena");

        $webService = new WebService();
        $dataSet = $webService->valida_alumno($clave, $contrasena);

        return response()->json($dataSet);
    }

    //Método del servicio web "Alumno"
    public function alumno(Request $request)
    {
        $clave = $request->input("clave_unica");
        $solicitud = $request->input("solicitud");
        //---------------Cuando se tenga el servicio web, sustituir por la lógica para llamar al servicio web desde la clase WebService

        $infoAlumno = $this->buscaAlumno($clave);
        if ($infoAlumno == null) {
            return response()->json(['mensaje' => 'Clave Única no encontrada'], 500);
        } else {
            $html = view('alumnos_tabla_datos', ['infoAlumno' => $infoAlumno])->render();
            if ($solicitud == "mu") {
                $mu = new MateriaUnicaController();

                $infoAlumnoMU = $mu->materiasNoReg($clave);

                if($infoAlumnoMU == null){//El alumno no tiene niguna materia registrada en base de datos
                    $ws = new WebService();
                    $infoAlumnoMU = $ws->materia_unica($clave);

                }
                $htmlMU = view('cs_materia_unica', ['infoAlumno' => $infoAlumnoMU])->render();
                return response()->json(['infoAlumno' => $html, 'infoAlumnoMU' => $htmlMU]);
            }
            
        }
    }





    //Función temporal para simular la respuesta del seervicio web
    private function buscaAlumno($clave_unica)
    {
        $ejemploAlumno = [
            [
                "clave_unica" => 295969,
                "clave_larga" => 201801500565,
                "nombre_alumno" => "MARTINEZ LOPEZ IVAN",
                "rpe_coordinador" => '123',
                "nombre_coordinador" => 'VACA RIVERA SILVIA LUZ',
                "rpe_tutor" => '456',
                "nombre_tutor" => 'VITAL OCHOA OMAR',
                "cve_carrera" => '789',
                "nombre_carrera" => 'INGENIERIA EN COMPUTACION'
            ],
            [
                "clave_unica" => 295934,
                "clave_larga" => 0,
                "nombre_alumno" => "",
                "rpe_coordinador" => '',
                "nombre_coordinador" => '',
                "rpe_tutor" => '',
                "nombre_tutor" => '',
                "cve_carrera" => '',
                "nombre_carrera" => ''
            ],
            [
                "clave_unica" => 247747,
                "clave_larga" => 0,
                "nombre_alumno" => "",
                "rpe_coordinador" => '',
                "nombre_coordinador" => '',
                "rpe_tutor" => '',
                "nombre_tutor" => '',
                "cve_carrera" => '',
                "nombre_carrera" => ''
            ],
            [
                "clave_unica" => 258374,
                "clave_larga" => 0,
                "nombre_alumno" => "",
                "rpe_coordinador" => '',
                "nombre_coordinador" => '',
                "rpe_tutor" => '',
                "nombre_tutor" => '',
                "cve_carrera" => '',
                "nombre_carrera" => ''
            ],
            [
                "clave_unica" => 262000,
                "clave_larga" => 0,
                "nombre_alumno" => "",
                "rpe_coordinador" => '',
                "nombre_coordinador" => '',
                "rpe_tutor" => '',
                "nombre_tutor" => '',
                "cve_carrera" => '',
                "nombre_carrera" => ''
            ],
            [
                "clave_unica" => 286621,
                "clave_larga" => 0,
                "nombre_alumno" => "",
                "rpe_coordinador" => '',
                "nombre_coordinador" => '',
                "rpe_tutor" => '',
                "nombre_tutor" => '',
                "cve_carrera" => '',
                "nombre_carrera" => ''
            ],

        ];


        $encontrado = false;
        for ($i = 0; $i < count($ejemploAlumno); $i++) {
            if ($ejemploAlumno[$i]['clave_unica'] == $clave_unica) {
                return ($ejemploAlumno[$i]);
            }
        }

        return null;
    }
}
