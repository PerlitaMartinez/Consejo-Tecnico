<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\View\View;
use SoapClient;

class AuthController extends Controller
{
    public function showLoginForm($userType): View
    {

        $rol = strtoupper($userType);
        $clave = "";
        if ($rol == "ACADEMICOS") {
            $clave = "RPE";
            $rol = "ACADÉMICOS";
        } elseif ($rol == "ALUMNOS") {
            $clave = "Clave Única";
        } else {
            abort(404);
        }

        return view('login', ['rol' => $rol, 'clave' => $clave]);
    }


    public function login(Request $request): RedirectResponse
    {
        // $claveUnica = $request->input('clave_unica');
        // $contrasena = $request->input('contrasena');

        $url = "https://servicios.ing.uaslp.mx/ws_hctc/ws_hctc.svc?singleWsdl";
        $options = array(
            'cache_wsdl' => 0,
            'trace' => 1,
            'stream_context' => stream_context_create(array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            ))
        );
        //----------------------- SOLICITUD ----------------------------------------------
        $client = new SoapClient($url, $options);
        //--------------------------------------------------------------------------------

        $array = ["key_sw" => '4B4E-AC4E-2BE82F8704BE', "clave_unica" => $request->input('clave_unica'), "contrasena" => $request->input('contrasena')];
        $result = $client->valida_alumno($array);
        $xml = simplexml_load_string($result->valida_alumnoResult->any);
        
        for ($i = 0; $i < count($xml->NewDataSet->TablaMensaje); $i++) {
            //var_dump(count($xml->NewDataSet->TablaMensaje));

            $lista = $xml->NewDataSet->TablaMensaje[$i]; // Varible para acceder de manera más sencilla a los datos

            // Así se accede a un campo, ¡¡¡¡pero es necesario convertirlo a String!!!!
            /* Creamos una colección con los datos que consultamos del usuario
        */
            $fila = [
                'clave_unica' => $lista->clave_unica->__toString(),
                'nombre_alumno' => $lista->nombre_alumno->__toString(),
                'tiene_materia_unica' => $lista->tiene_materia_única->__toString(),
                'esta_carga_maxima' => $lista->esta_carga_máxima->__toString(),
                'situacion_alumno' => $lista->situación_alumno->__toString(),
                'validacion' => $lista->validacion->__toString(),
            ];


           /* echo "clave_unica: " . $alumno["clave_unica"] . "<br \>";
            echo "nombre_alumno: " . $alumno["nombre_alumno"] . "<br \>";
            echo "tiene_materia_única: " . $alumno["tiene_materia_unica"] . "<br \>";
            echo "esta_carga_máxima: " . $alumno["esta_carga_maxima"] . "<br \>";
            echo "situación_alumno: " . $alumno["situacion_alumno"] . "<br \>";
            echo "validación: " . $alumno["validacion"] . "<br \>";


            echo "<br \>";*/
            $dataSet[] = $fila;
        }


      
        return redirect()->route('inicio.index', ['dataSet' => $dataSet]);
    }
}
