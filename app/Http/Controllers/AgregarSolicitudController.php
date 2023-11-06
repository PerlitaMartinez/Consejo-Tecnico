<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AgregarSolicitudController extends Controller
{
    public function agregarSolicitudShow(){
        return view("agregar_solicitud");
    }
}
