<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    //***************IMPORTANTE CREAR EL MIDDLEWARE PARA VERIFICAR QUE EL ALUMNO ESTÉ VERIFICADO*******/
    // /**
    //  * Create a new controller instance.
    //  *
    //  * @return void
    //  */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    // /**
    //  * Show the application dashboard.
    //  *
    //  * @return \Illuminate\Contracts\Support\Renderable
    //  */
    public function index(Request $request)
    {
        $dataSet = $request->input('dataSet');        
        return view('inicio', ['dataSet' => $dataSet]);
    }
}
