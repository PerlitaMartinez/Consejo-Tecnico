<?php

use App\Http\Controllers\DemoController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/hctc/alumnos', function(){
    $rol = "ESTUDIANTES";
    $clave = "Clave única";
    return view('login', ['rol' => $rol, 'clave' => $clave]);
})->name('loginAlumnos');

Route::get('/hctc/academicos', function(){
    $rol = "ACADÉMICOS";
    $clave = "RPE";
    return view('login', ['rol' => $rol, 'clave' => $clave]);
})->name('loginAcademicos');


Route::get('/hctc/inicio', function(){
    return view('inicio');
})->name('inicio');

Route::get('/hctc/solicitudes/titulacion', function(){
    return view('inicio_alumno_opciones_titulacion');
})->name('inicio_alumno_opciones_titulacion');

Route::get('/hctc/registro_tema', function(){
    return view('registro_tema');
})->name('registro_tema');

Route::get('/hctc/opcion_titulacion', function(){
    return view('opcion_titulacion');
})->name('opcion_titulacion');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('/generar-pdf', [DemoController::class, 'AddtoPdf']);
