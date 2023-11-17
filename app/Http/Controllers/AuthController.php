<?php

namespace App\Http\Controllers;

use App\Helpers\WebService;
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
        $webService = new WebService();
        $dataSet = $webService->valida_alumno($request->input('clave_unica'), $request->input('contrasena'));

        return redirect()->route('inicio.index', ['dataSet' => $dataSet]);
    }
}
