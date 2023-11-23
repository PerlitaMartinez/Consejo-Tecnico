<?php

namespace App\Http\Controllers;

use App\Helpers\WebService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\View\View;
use SoapClient;
use Spatie\Permission\Traits\HasRoles;

class AuthController extends Controller
{
    //use HasRoles;
    public function showLoginForm($userType): View
    {

        $rol = strtoupper($userType);
        $clave = "";
        if ($rol == "ACADEMICOS") {
            $clave = "RPE";
            $rol = "ACADEMICOS";
        } elseif ($rol == "ALUMNOS") {
            $clave = "Clave Única";
            $rol = "ALUMNOS";
        } else {
            abort(404);
        }

        return view('login', ['rol' => $rol, 'clave' => $clave]);
    }


    public function login(Request $request): RedirectResponse
    {
        $clave = $request->input('clave');
        $rol = $request->input('rol');
        // $contrasena = $request->input('contrasena');
        $webService = new WebService();
        $dataSet = $webService->valida_alumno($request->input('clave_unica'), $request->input('contrasena'));


        $respuesta = $dataSet[0]['validacion'];
        $clave = $dataSet[0]['clave_unica'];


        $mensaje ="Clave o contraseña incorrectas.";
        $respuesta = $dataSet[0]['validacion'];
        $clave = $dataSet[0]['clave_unica'];

        if($respuesta === "USUARIO-VALIDO" && $rol == "ALUMNOS")
        {
            return redirect()->route('inicio.index', ['dataSet' => $dataSet]);
        
        }
        if($rol == "ACADEMICOS" && $respuesta === "USUARIO-VALIDO"){

            return redirect()->route('rol');
        }

        return redirect()->route('login.show',$rol)->with('success', $mensaje);

       
    }
}
