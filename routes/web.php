<?php

use App\Http\Controllers\AgregarSolicitudController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CargaMaximaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MateriaUnicaController;
use App\Http\Controllers\OpcionTitulacionController;
use App\Http\Controllers\PdfGeneratorController;
use App\Http\Controllers\SeguimientoSolicitudController;
use App\Http\Controllers\TramitesController;
use App\Http\Middleware\CheckFormCargaMaximaCompletion;
use App\Http\Middleware\CheckFormMateriaUnicaCompletion;
use App\Http\Middleware\CheckFormOpTitulacionCompletion;
use App\Models\MateriaUnicaModel;
use Doctrine\DBAL\Logging\Middleware;
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
Route::post('materiaUnica-post', [MateriaUnicaController::class, 'storeMateriaUnica'])->name('materiaUnica.store');
Route::get('materiaUnicaPDF', [MateriaUnicaController::class,'materiaUnicaPDFshow'])->name('materiaUnicaPDF.show');
Route::delete('materiaUnica-delete', [MateriaUnicaController::class,'materiaUnicaDelete'])->name('materiaUnica.delete');
Route::get('administrador/materiaUnica', [MateriaUnicaController::class, 'materiaUnicaShowAdministrador'])->name('materiaUnicaAdmin.show');
Route::post('administrador/materiaUnica-post', [MateriaUnicaController::class, 'storeMateriaUnicaAdmin'])->name('materiaUnicaAdmin.store');


Route::get('cargaMaxima', [CargaMaximaController::class, 'showCargaMaximaForm'])->name('cargaMaxima.show');
Route::post('cargaMaxima-post', [CargaMaximaController::class, 'cargaMaximaStore'])->name('cargaMaxima.store');
Route::get('cargaMaximaPDF', [CargaMaximaController::class,'cargaMaximaPDFshow'])->name('cargaMaximaPDF.show');
Route::delete('cargaMaxima-delete', [CargaMaximaController::class,'cargaMaximaDelete'])->name('cargaMaxima.delete');
Route::get('administrador/cargaMaxima', [CargaMaximaController::class, 'showCargaMaximaFormAdmin'])->name('cargaMaximaAdmin.show');
Route::post('administrador/cargaMaxima-post', [CargaMaximaController::class, 'cargaMaximaStoreAdmin'])->name('cargaMaximaAdmin.store');

Route::get('titulacion', [OpcionTitulacionController::class, 'showTitulacionForm'])->name('titulacion.show');
Route::post('opTitulacion-post', [OpcionTitulacionController::class, 'opcionTitulacionStore'])->name('opcionTitulacion.store');
Route::get('opTitulacionPDF', [OpcionTitulacionController::class,'opTitulacionPDFshow'])->name('opTitulacionPDF.show');
Route::delete('opTitulacion-delete', [OpcionTitulacionController::class,'opcionTitulacionDelete'])->name('opcionTitulacion.delete');
Route::get('administrador/titulacion', [OpcionTitulacionController::class, 'showTitulacionFormAdmin'])->name('titulacionAdmin.show');
Route::post('administrador/opTitulacion-post', [OpcionTitulacionController::class, 'opcionTitulacionStoreAdmin'])->name('opcionTitulacionAdmin.store');

Route::get('seguimiento', [SeguimientoSolicitudController::class, 'SeguimientoShow'])->name('seguimiento.show');



Route::get('/hctc/formato_registro_tema', function () {
    return view('formato_registro_tema');
})->name('formato_registro_tema');

Route::get('/hctc/TerminacionTrabajoRecepcionalTesisMemorias', function(){
    return view('terminacion_trabajo_recepcional_tesis_memorias');
})->name('terminacion_trabajo_recepcional_tesis_memorias');

Route::get('/hctc/ProgramaTitulacion', function(){
    return view('aspirantes_programa_titulacion');
})->name('aspirantes_programa_titulacion');

Route::get('/hctc/RegistroTemaTemarioMemorias', function(){
    return view('registro_tema_temario_memorias');
})->name('registro_tema_temario_memorias');

Route::get('/hctc/rol', function(){
    return view('rol');
})->name('rol');


Route::get('agregarSolicitud', [AgregarSolicitudController::class,'agregarSolicitudShow'])->name('agregarSolicitud.show');

//Route::get('/generar-pdf', [PdfGeneratorController::class, 'cargaMaximaGenerate'])->name('cargaMaximaPdf.show');

//Route::get('/cargaMaxima', [TramitesController::class, 'showFormCargaMaxima'])->name('cargaMaxima.show');

//Route::post('/guarda-datos', [PdfGeneratorController::class, 'guardarDatos'])->name('saveCargaMaxima.create');

//Route::get('/generar-pdf2', [PdfGeneratorController::class, 'materiaUnicaGenerate'])->name('materiaUnicaPdf.show');


//Route::post('/guarda-datos', [PdfGeneratorControllerCM::class, 'guardarDatos'])->name('savemateriaUnica.create');

//Route::get('/generar-pdf3', [PdfGeneratorController::class, 'opcionTitulacionGenerate'])->name('opcionTitulacionPdf.show');

//Route::get('/opcionTitulacion', [TramitesController::class, 'showFormopcionTitulacion'])->name('opcionTitulacion.show');

Route::get('/generar-pdf4', [PdfGeneratorController::class, 'registroTemaGenerate'])->name('registroTemaPdf.show');

Route::get('/registroTema', [TramitesController::class, 'showFormregistroTema'])->name('registroTema.show');
