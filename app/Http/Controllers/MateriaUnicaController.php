<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MateriaUnicaController extends Controller
{
    public function showMateriaUnicaForm(Request $request)
    {
        $dataSet = $request->input('dataSet');
        return view('materiaUnica', ['dataSet' => $dataSet]);
    }

}
