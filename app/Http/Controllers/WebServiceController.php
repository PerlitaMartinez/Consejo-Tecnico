<?php

namespace App\Http\Controllers;

use App\Helpers\WebService;
use Illuminate\Http\Request;

class WebServiceController extends Controller
{
    public function validaAlumno(Request $request){
        $clave = $request->input("clave_unica");
        $contrasena = $request->input("contrasena");

        $webService = new WebService();
        $dataSet = $webService->valida_alumno( $clave, $contrasena );

        return response()->json($dataSet);
    }
}
