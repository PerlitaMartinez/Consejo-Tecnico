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
use App\Http\Controllers\WebServiceController;
use App\Http\Middleware\CheckFormCargaMaximaCompletion;
use App\Http\Middleware\CheckFormMateriaUnicaCompletion;
use App\Http\Middleware\CheckFormOpTitulacionCompletion;
use App\Models\MateriaUnicaModel;
use Doctrine\DBAL\Logging\Middleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SesionesController;

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

Route::get('validaAlumno', [WebServiceController::class,'validaAlumno'])->name('validaAlumnoGet');


Route::get('/login/{userType}', [AuthController::class, 'showLoginForm'])->name('login.show');
Route::post('post-login', [AuthController::class, 'login'])->name('login.sumbit');


//Route::get('inicio', [HomeController::class, 'index'])->name('inicio.index');

Route::get('materiaUnica', [MateriaUnicaController::class, 'showMateriaUnicaForm'])->name('materiaUnica.show');
Route::post('materiaUnica-post', [MateriaUnicaController::class, 'storeMateriaUnica'])->name('materiaUnica.store');
Route::get('materiaUnicaPDF', [MateriaUnicaController::class,'materiaUnicaPDFshow'])->name('materiaUnicaPDF.show');
Route::delete('materiaUnica-delete', [MateriaUnicaController::class,'materiaUnicaDelete'])->name('materiaUnica.delete');
Route::get('administrador/materiaUnica', [MateriaUnicaController::class, 'materiaUnicaShowAdministrador'])->name('materiaUnicaAdmin.show');
Route::post('administrador/materiaUnica-post', [MateriaUnicaController::class, 'storeMateriaUnicaAdmin'])->name('materiaUnicaAdmin.store');
Route::get('materiaUnica-getRegistros', [MateriaUnicaController::class,'fetchMateriaUnicaClave'])->name('materiaUnicaReg');
Route::get('materiaUnica-getAllRegistros', [MateriaUnicaController::class,'fetchMateriaUnicaAllRegisters'])->name('materiaUnicaAllReg');
Route::post('/cancelarMU/{id}', [MateriaUnicaController::class, 'updateCancelar'])->name('cancelarMU');
Route::post('/autorizarMU/{id}', [MateriaUnicaController::class, 'updateAutorizar'])->name('autorizarMU');
Route::get('/detallesMU/{id}', [MateriaUnicaController::class,'mostrarDetallesMU'])->name('detallesMU');

Route::get('cargaMaxima', [CargaMaximaController::class, 'showCargaMaximaForm'])->name('cargaMaxima.show');
Route::post('cargaMaxima-post', [CargaMaximaController::class, 'cargaMaximaStore'])->name('cargaMaxima.store');
Route::get('cargaMaximaPDF', [CargaMaximaController::class,'cargaMaximaPDFshow'])->name('cargaMaximaPDF.show');
Route::delete('cargaMaxima-delete', [CargaMaximaController::class,'cargaMaximaDelete'])->name('cargaMaxima.delete');
Route::get('administrador/cargaMaxima', [CargaMaximaController::class, 'showCargaMaximaFormAdmin'])->name('cargaMaximaAdmin.show');
Route::post('administrador/cargaMaxima-post', [CargaMaximaController::class, 'cargaMaximaStoreAdmin'])->name('cargaMaximaAdmin.store');
Route::get('cargaMaxima-getRegistros', [CargaMaximaController::class, 'fetchCargaMaxima'])->name('cargaMaximaReg');
Route::get('cargaMaxima-getAllRegistros', [CargaMaximaController::class, 'fetchAllCargaMaxima'])->name('cargaMaximaRegAll');
Route::post('/cancelarCM/{id}', [CargaMaximaController::class, 'updateCancelar'])->name('cancelarCM');
Route::post('/autorizarCM/{id}', [CargaMaximaController::class, 'updateAutorizar'])->name('autorizarCM');
Route::get('/detallesCM/{id}', [CargaMaximaController::class,'mostrarDetallesCM'])->name('detallesCM');


Route::get('titulacion', [OpcionTitulacionController::class, 'showTitulacionForm'])->name('titulacion.show');
Route::post('opTitulacion-post', [OpcionTitulacionController::class, 'opcionTitulacionStore'])->name('opcionTitulacion.store');
Route::get('opTitulacionPDF', [OpcionTitulacionController::class,'opTitulacionPDFshow'])->name('opTitulacionPDF.show');
Route::delete('opTitulacion-delete', [OpcionTitulacionController::class,'opcionTitulacionDelete'])->name('opcionTitulacion.delete');
Route::get('administrador/titulacion', [OpcionTitulacionController::class, 'showTitulacionFormAdmin'])->name('titulacionAdmin.show');
Route::post('administrador/opTitulacion-post', [OpcionTitulacionController::class, 'opcionTitulacionStoreAdmin'])->name('opcionTitulacionAdmin.store');
Route::get('opTitulacion-getRegistros', [OpcionTitulacionController::class,'fetchOpcionTitulacion'])->name('opcionTitulacionReg');
Route::get('opTitulacion-getAllRegistros', [OpcionTitulacionController::class,'fetchAllOpcionTitulacion'])->name('opcionTitulacionAllReg');
Route::post('/cancelarOT/{id}', [OpcionTitulacionController::class, 'updateCancelar'])->name('cancelarOT');
Route::post('/autorizarOT/{id}', [OpcionTitulacionController::class, 'updateAutorizar'])->name('autorizarOT');
Route::get('/detallesOT/{id}', [OpcionTitulacionController::class,'mostrarDetallesOT'])->name('detallesOT');

Route::get('seguimiento', [SeguimientoSolicitudController::class, 'SeguimientoShow'])->name('seguimiento.show');
Route::get('agregarSolicitud', [AgregarSolicitudController::class,'agregarSolicitudShow'])->name('agregarSolicitud.show');


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

//ruta para el boton de administrador de la pantalla de roles
Route::get('/administrador', function () {
    return view('administrador'); 
})->name('administrador');

Route::get('/staff', function () {
    return view('staff'); // Reemplaza 'staff' 
})->name('staff');

//ruta para el boton de director y secretario de la pantalla de roles
Route::get('/director%secretario', function () {
    return view('director_secretario');
})->name('director_secretario');

//CONTROLADOR DE SESIONES
Route::get('/sesiones', [SesionesController::class,'index'])->name('admin_sesiones_hctc');
Route::post('/sesiones', [SesionesController::class,'crear'])->name('admin_sesiones_crear');

Route::get('/consultar', function () {
    return view('consultar_solicitudes');
})->name('consultar_solicitudes');

Route::get('/sesiones', function () {
    return view('admin_sesiones_hctc'); 
})->name('admin_sesiones_hctc');

Route::get('/consulta_materia_unica_reporte', function () {
    return view('consultar_solicitud_materiaUnica_reporte'); 
})->name('consultar_solicitud_materiaUnica_reporte');

Route::get('/crear/solictud/carga/maxima', function () {
    return view('crear_solicitud_carga_maxima'); 
})->name('crear_solicitud_carga_maxima');

Route::get('/crear/solictud/materia/unica', function () {
    return view('crear_solicitud_materia_unica'); 
})->name('crear_solicitud_materia_unica');

Route::get('/consultarSolicitudMateriaUnica', function () {
    return view('consultar_materia_unica_Staff'); 
})->name('consultar_materia_unica_Staff');

Route::get('/crear/Solicitud/opcion/titulacion', function () {
    return view('crear_solicitud_opcion_titulacion'); 
})->name('crear_solicitud_opcion_titulacion');

Route::get('/consultar_carga_maxima_reporte', function () {
    return view('consultar_carga_maxima_reporte'); 
})->name('consultar_carga_maxima_reporte');

Route::get('/consultar_opcion_titulacion_tesis_reporte', function () {
    return view('consultar_opcion_titulacion_tesis_reporte'); 
})->name('consultar_opcion_titulacion_tesis_reporte');

Route::get('/consultar_opcion_titulacion_reporte', function () {
    return view('consultar_opcion_titulacion_reporte'); 
})->name('consultar_opcion_titulacion_reporte');

Route::get('/tutor', function () {
    return view('tutor'); //vista de tutor
})->name('tutor');

Route::get('/tutorados', function () {
    return view('tutorados'); //vista de tutor
})->name('tutorados');

Route::get('/jefe_area', function () {
    return view('jefe_area'); //vista de tutor
})->name('jefe_area');

Route::get('/coordinador', function () {
    return view('coordinador'); //vista de tutor
})->name('coordinador');

//Route::get('/consultar', [HomeController::class, 'mostrarTodasSolicitudes'])->name('consultar_solicitudes');



//Route::get('/generar-pdf', [PdfGeneratorController::class, 'cargaMaximaGenerate'])->name('cargaMaximaPdf.show');

//Route::get('/cargaMaxima', [TramitesController::class, 'showFormCargaMaxima'])->name('cargaMaxima.show');

//Route::post('/guarda-datos', [PdfGeneratorController::class, 'guardarDatos'])->name('saveCargaMaxima.create');

//Route::get('/generar-pdf2', [PdfGeneratorController::class, 'materiaUnicaGenerate'])->name('materiaUnicaPdf.show');


//Route::post('/guarda-datos', [PdfGeneratorControllerCM::class, 'guardarDatos'])->name('savemateriaUnica.create');

//Route::get('/generar-pdf3', [PdfGeneratorController::class, 'opcionTitulacionGenerate'])->name('opcionTitulacionPdf.show');

//Route::get('/opcionTitulacion', [TramitesController::class, 'showFormopcionTitulacion'])->name('opcionTitulacion.show');

Route::get('/generar-pdf4', [PdfGeneratorController::class, 'registroTemaGenerate'])->name('registroTemaPdf.show');

Route::get('/registroTema', [TramitesController::class, 'showFormregistroTema'])->name('registroTema.show');
