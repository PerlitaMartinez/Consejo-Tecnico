<?php

namespace App\Http\Controllers;

use App\Models\SesionHctcModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SesionesController extends Controller{
   


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

    public function edit(SesionHctcModel $sesion){
        return view('editSesiones', ['sesion' => $sesion]);

    }

    public function update(Request $request, SesionHctcModel $sesion){
        $request->validate([
            'fecha_sesion' => ['required'],
            'tipo_sesion' => ['required',]
        ]);

        $sesion->fecha_sesion = $request->input('fecha_sesion');
        $sesion->tipo_sesion = $request->input('tipo_sesion');
        $sesion->timestamps=false;
        $sesion->save();

        session()->flash('status', 'Sesion updated!');

        return to_route('admin_sesiones_hctc');

        
    }
 
}
