<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CargaMaximaController extends Controller
{
    public function showCargaMaximaForm(Request $request)
    {
        $dataSet = $request->input('dataSet');
        //dd($dataSet);
        return view('cargaMaxima', ['dataSet' => $dataSet]);
    }

    
}
