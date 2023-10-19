<?php

use App\Http\Controllers\PdfGeneratorController;
use App\Http\Controllers\TramitesController;
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

Route::get('/hctc/materia_unica', function(){
    return view('materiaUnica');
})->name('materiaUnica');

Route::get('/hctc/carga_maxima', function(){
    return view('cargaMaxima');
})->name('cargaMaxima');

Route::get('/hctc/formato_opcion_titulacion', function(){
    return view('formato_opcion_titulacion');
})->name('formato_opcion_titulacion');

Route::get('/hctc/formato_registro_tema', function(){
    return view('formato_registro_tema');
})->name('formato_registro_tema');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('/generar-pdf', [PdfGeneratorController::class, 'cargaMaximaGenerate'])->name('cargaMaximaPdf.show');

Route::get('/cargaMaxima', [TramitesController::class, 'showFormCargaMaxima'])->name('cargaMaxima.show');

Route::post('/guarda-datos', [PdfGeneratorController::class, 'guardarDatos'])->name('saveCargaMaxima.create');

Route::get('/generar-pdf2', [PdfGeneratorController::class, 'materiaUnicaGenerate'])->name('materiaUnicaPdf.show');

Route::get('/materiaUnica', [TramitesController::class, 'showFormMateriaUnica'])->name('materiaUnica.show');

//Route::post('/guarda-datos', [PdfGeneratorControllerCM::class, 'guardarDatos'])->name('savemateriaUnica.create');

Route::get('/generar-pdf3', [PdfGeneratorController::class, 'opcionTitulacionGenerate'])->name('opcionTitulacionPdf.show');

Route::get('/opcionTitulacion', [TramitesController::class, 'showFormopcionTitulacion'])->name('opcionTitulacion.show');

Route::get('/generar-pdf4', [PdfGeneratorController::class, 'registroTemaGenerate'])->name('registroTemaPdf.show');

Route::get('/registroTema', [TramitesController::class, 'showFormregistroTema'])->name('registroTema.show');