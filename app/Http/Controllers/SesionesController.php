<?php

namespace App\Http\Controllers;

use App\Models\SesionHctcModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SesionesController extends Controller{
    /*public function crearSesion(Request $request)
    {
        //Validar los datos del formulario si es necesario
        $request->validate([
            'id_sesion_hctc' => 'required|integer',
            'fecha_sesion' => 'required|string',
            'tipo_sesion' => 'required|string',
        ]);

        $sesion = sesion_hctc::create([
            'id_sesion_hctc' => $request->input('integer'),
            'fecha_sesion'=> $request->input('string'),
            'tipo_sesion' => $request->input('string'),
        ]);
    }*/


    public function index(){

        $sesiones = SesionHctcModel::all();
        return view('admin_sesiones_hctc', compact('sesiones'));

    }

    public function crear(Request $request){
       // return $request->all();

       $sesionNueva = new SesionHctcModel;
       $sesionNueva->fecha_sesion= $request->fecha_sesion;
       $sesionNueva->tipo_sesion= $request -> tipo_sesion;
       $sesionNueva->timestamps=false;

       $sesionNueva->save();
       return back()->with('mensaje', 'SESION AGREGADA CORRECTAMENTE');
    }

    public function destroy(SesionHctcModel $sesion  ){

        $sesion->delete();
        return back()->with('mensaje', 'SESION ELIMINADA CORRECTAMENTE');

    }

 
}
