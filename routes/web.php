<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CargaMaximaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MateriaUnicaController;
use App\Http\Controllers\OpcionTitulacionController;
use App\Http\Controllers\PdfGeneratorController;
use App\Http\Controllers\TramitesController;
use App\Models\MateriaUnicaModel;
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
    return  view('welcome');
});


Route::get('/login/{userType}', [AuthController::class, 'showLoginForm'])->name('login.show');
Route::post('post-login', [AuthController::class, 'login'])->name('login.sumbit');

Route::get('inicio', [HomeController::class, 'index'])->name('inicio.index');

Route::get('materiaUnica', [MateriaUnicaController::class, 'showMateriaUnicaForm'])->name('materiaUnica.show');

Route::get('cargaMaxima', [CargaMaximaController::class, 'showCargaMaximaForm'])->name('cargaMaxima.show');

Route::get('titulacion', [OpcionTitulacionController::class, 'showTitulacionForm'])->name('titulacion.show');

Route::get('/hctc/formato_registro_tema', function () {
    return view('formato_registro_tema');
})->name('formato_registro_tema');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


//Route::get('/generar-pdf', [PdfGeneratorController::class, 'cargaMaximaGenerate'])->name('cargaMaximaPdf.show');

//Route::get('/cargaMaxima', [TramitesController::class, 'showFormCargaMaxima'])->name('cargaMaxima.show');

//Route::post('/guarda-datos', [PdfGeneratorController::class, 'guardarDatos'])->name('saveCargaMaxima.create');

Route::get('/generar-pdf2', [PdfGeneratorController::class, 'materiaUnicaGenerate'])->name('materiaUnicaPdf.show');


//Route::post('/guarda-datos', [PdfGeneratorControllerCM::class, 'guardarDatos'])->name('savemateriaUnica.create');

Route::get('/generar-pdf3', [PdfGeneratorController::class, 'opcionTitulacionGenerate'])->name('opcionTitulacionPdf.show');

//Route::get('/opcionTitulacion', [TramitesController::class, 'showFormopcionTitulacion'])->name('opcionTitulacion.show');

Route::get('/generar-pdf4', [PdfGeneratorController::class, 'registroTemaGenerate'])->name('registroTemaPdf.show');

Route::get('/registroTema', [TramitesController::class, 'showFormregistroTema'])->name('registroTema.show');
