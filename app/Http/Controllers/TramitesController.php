<?php

namespace App\Http\Controllers;

use App\Models\CargaMaximaModel;
use Illuminate\Http\Request;

class TramitesController extends Controller
{
    public function showFormCargaMaxima()
    {
        return view('cargaMaxima');
    }

   
}
