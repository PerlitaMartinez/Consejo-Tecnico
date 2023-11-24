<?php

namespace App\Http\Controllers;

use App\Helpers\WebService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\View\View;
use SoapClient;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Facades\DB;

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
        $tipo ="";
        $roles = DB::select('select idrol from roles_usuarios where id_usuario =?',[
             $clave,
        ]);
        foreach($roles as $per)
        {
            $tipo = $per->idrol;
        }

        if($respuesta === "USUARIO-VALIDO" && $rol == "ALUMNOS")
        {
            return redirect()->route('inicio.index', ['dataSet' => $dataSet]);
        
        }
        if($rol == "ACADEMICOS" && $respuesta === "USUARIO-VALIDO"){
            if($tipo == 1)
            {
                return redirect()->route('rol',['roles'=>$roles]);
            }
           
        }

        return redirect()->route('login.show',$rol)->with('success', $mensaje);

       
    }
}
