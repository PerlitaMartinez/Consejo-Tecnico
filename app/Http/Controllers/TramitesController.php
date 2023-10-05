<?php

namespace App\Http\Controllers;

use App\Models\CargaMaximaModel;
use App\Models\MateriaUnicaModel;
use Illuminate\Http\Request;

class TramitesController extends Controller
{
    public function showFormCargaMaxima()
    {
        return view('cargaMaxima');
    }

    public function showFormMateriaUnica()
    {
        return view('materiaUnica');
    }

   
}
