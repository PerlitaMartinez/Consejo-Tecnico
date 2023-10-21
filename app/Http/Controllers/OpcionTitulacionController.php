<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OpcionTitulacionController extends Controller
{
    public function showTitulacionForm(Request $request)
    {
        $dataSet = $request->input('dataSet');
        //dd($dataSet);
        return view('formato_opcion_titulacion', ['dataSet' => $dataSet]);
    }
}
