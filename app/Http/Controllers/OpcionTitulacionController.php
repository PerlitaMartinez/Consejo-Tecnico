<?php

namespace App\Http\Controllers;

use App\Models\CatOpcionTitulacionModel;
use App\Models\OpcionTitulacionModel;
use Exception;
use Illuminate\Http\Request;
use setasign\Fpdi\Fpdi;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OpcionTitulacionController extends Controller
{
    protected $dataAlumno = [
        [
            "clave_unica" => 39999, //<-----Usar la clave única del servicio web
            "ultima_materia" => "23/10/2023",
            "promedio_ap" => "8.0",
            "semestre" => "2023-2024/I",
            "ingreso" => "2023-2024/I",
        ],

    ];
    public function showTitulacionForm(Request $request)
    {
        $dataSet = $request->input('dataSet');
        $id = $request->input('id');
        //Se obtienen todas las opciones de titulación
        $opciones = CatOpcionTitulacionModel::all();

        //Se verifica si ya se tiene una solicitd de titulación ya registrada
        $exists = $this->opTitulacionRegister($dataSet);



        return view('formato_opcion_titulacion', ['dataSet' => $dataSet, 'dataAlumno' => $this->dataAlumno, 'exists' => $exists, 'opciones' => $opciones, 'id' => $id]); //<----Cambiar por servicio web
    }


    public function opcionTitulacionStore(Request $request)
    {

        $dataSet = $request->has('dataSet') ? $request->input('dataSet') : null;
        $opcionTitulacionSeleccionada = $request->input('opcion_titulacion');
        $rol = $request->input('rol');
        if ($dataSet !== null && count($dataSet) > 0)
            $clave_unica = $dataSet[0]['clave_unica'];
        else {
            $clave_unica = 295969;
        }
       
        //verificamos que no haya una solicitud activa en la base de datos
        $resultado = OpcionTitulacionModel::where('clave_unica', $clave_unica) //<--- Cambiar por datos del servicio web
            ->where(function ($query) {
                $query->where('estado_solicitud', 'ALTA')
                    ->orWhere('estado_solicitud', 'AUTORIZADA');
            })
            ->get();
        if ($dataSet !== null) {
            if ($resultado != null && $resultado->count() > 0) {
                return back()->with('error', 'No tienes permitido hacer esta solicitud');
            }
        }
        //El alumno no tiene ninguna solicitud registrada
        $opcionTitulacion = new OpcionTitulacionModel();
        $opcionTitulacion->fecha_solicitud = now()->format('Y-m-d');
        $opcionTitulacion->semestre = $this->dataAlumno[0]['semestre']; //<----Cambiar cuando se tenga el servicio web
        $opcionTitulacion->estado_solicitud = "ALTA";
        $opcionTitulacion->clave_unica =  $clave_unica;
        $opcionTitulacion->id_opcion_titulacion = $opcionTitulacionSeleccionada;
        $opcionTitulacion->save();

        if ($rol == 'RPE') {
            return response()->json(['id' => $opcionTitulacion->id_solicitud_OT], 200);
        }
        $newId = $opcionTitulacion->id_solicitud_OT;
        $mensaje = "Solicitud registrada con éxito.";
        return redirect()->route('titulacion.show', ['dataSet' =>  $dataSet, 'id' => $newId])->with('success', $mensaje);
    }



    protected function opTitulacionRegister($dataSet)
    {

        $registro = OpcionTitulacionModel::where('clave_unica', $dataSet[0]['clave_unica']) //<--- Cambiar por datos del servicio web
            ->where(function ($query) {
                $query->where('estado_solicitud', 'ALTA')
                    ->orWhere('estado_solicitud', 'AUTORIZADA');
            })
            ->first();
        return $registro;
    }


    public function opTitulacionPDFshow(Request $request)
    {

        $vistaAdmin = $request->input('vistaAdmin');
        $dataSet = $request->input('dataSet');
        if (gettype($dataSet) === 'string') {
            $dataSet = json_decode($request->input('dataSet'), true);
        } else {
            $dataSet = $request->input('dataSet');
        }

        $nombre = 'MARTINEZ LOPEZ IVAN';
        $clave = '295969';
        if (isset($dataSet) || $dataSet != null) {
            $nombre =  $dataSet[0]['nombre_alumno'];
            $clave = $dataSet[0]['clave_unica'];
        }
        //Se obtiene la información de la base de datos.
        $id = $request->input('id');
        $registro = OpcionTitulacionModel::find($id);

        //verificamos que exista el registro
        if (!$registro) {
            return back()->with('error', 'Solicitud no registrada.');
        }



        //Procesamos la fecha para colocarla en el pdf
        $fechaSolicitud =  $registro->fecha_solicitud;
        $carbonFecha = \Carbon\Carbon::parse($fechaSolicitud);

        //Registramos la fecha de impresión
        $registro->fecha_impresion = now();
        $registro->save();


        $pdf = new Fpdi('P', 'mm', 'A4');


        // add a page
        $pdf->AddPage('P', 'A4');
        $pdf->SetFont('Arial', 'B', 10);

        // set the source file
        $path = public_path("FormaCTTL01.pdf");

        $pdf->setSourceFile($path);

        // import page 1
        $tplId = $pdf->importPage(1);



        // use the imported page and place it at point 10,10 with a width of 100 mm
        $pdf->useTemplate($tplId, 0, 0, null, null, true);

        $pdf->SetXY(161, 55);
        $pdf->Write(0.1, $carbonFecha->day);
        $pdf->SetXY(175, 55);
        $pdf->Write(0.1, $carbonFecha->month);
        $pdf->SetXY(189, 55);
        $pdf->Write(0.1, $carbonFecha->year);
        $pdf->SetXY(90, 96);
        $pdf->Write(0.1, "EN COMPUTACION"); //<--Cambiar cuandoi tenga el servicio web

        //Dependiendo de la opción seleccionada se coloca la selección dentro del formato
        switch ($registro->id_opcion_titulacion) {

            case 1:
                $pdf->SetXY(26.5, 109);
                $pdf->Write(0.1, "X");
                break;
            case 2:
                $pdf->SetXY(26.5, 118);
                $pdf->Write(0.1, "X");
                break;
            case 3:
                $pdf->SetXY(26.5, 127);
                $pdf->Write(0.1, "X");
                break;
            case 4:
                $pdf->SetXY(26.5, 136.5);
                $pdf->Write(0.1, "X");
                break;
            case 5:
                $pdf->SetXY(26.5, 145.5);
                $pdf->Write(0.1, "X");
                break;
            case 6:
                $pdf->SetXY(111, 109);
                $pdf->Write(0.1, "X");
                break;
            case 7:
                $pdf->SetXY(111, 118);
                $pdf->Write(0.1, "X");
                break;

            case 8:
                $pdf->SetXY(111, 127);
                $pdf->Write(0.1, "X");
                break;

            case 9:
                $pdf->SetXY(111,  136.5);
                $pdf->Write(0.1, "X");
                break;
            case 10:
                $pdf->SetXY(111, 145.5);
                $pdf->Write(0.1, "X");
                break;
        }





        $pdf->SetXY(60, 203.5);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Write(0.1, $nombre);
        $pdf->SetXY(177, 203.5);
        $pdf->Write(0.1, $clave);
        $pdf->SetXY(140, 208.9);
        $pdf->Write(0.1, $this->dataAlumno[0]['ultima_materia']);
        $pdf->SetXY(88, 213.5);
        $pdf->Write(0.1, $this->dataAlumno[0]['promedio_ap']);
        $pdf->SetXY(180, 213.5);
        $pdf->Write(0.1, $this->dataAlumno[0]['ingreso']);



        //$pdf->SetXY(60, 213);
        //$pdf->Write(0.1,"2023-2024/I");
        // Preview PDF
        //$pdf->Output('I', "Demotest.pdf");

        // Download PDF
        //Download use D 
        $pdf->Output('I', 'OpcionTitulacion.pdf');

        // Save PDF to Particular path or project path

        //$pdf->Output('F', "/new/yourfoldername/Demotest.pdf");
    }




    public function opcionTitulacionCancel(Request $request)
    {

        $id = $request->input("id");
        $dataSet = json_decode($request->input('dataSet'), true);


        $registro = OpcionTitulacionModel::find($id);

        if (!$registro) {
            // Si no se encuentra el registro, se envía un mensaje de error
            return response()->json(['message' => "No se encontró el registro"])
                ->with('error', "No se pudo cancelar la solicitud.");
        }

        //Se cancela la solicitud
        $registro->estado_solicitud = "CANCELADA";
        $registro->save();
        //dd($registro);
        // El registro se eliminó satisfactoriamente.
        return response()->json(['message' => true]);
    }
    public function showTitulacionFormAdmin()
    {
        $opciones = CatOpcionTitulacionModel::all();

        return view('formato_opcion_titulacion', ['admin' => true, 'opciones' => $opciones]);
    }


    public function opcionTitulacionStoreAdmin(Request $request)
    {

        $data = $request->all();
        //dd($data);

        //Verificamos que los campos no estén vacios
        foreach ($data as $key => $value) {
            if (empty($value) || $value == null || $value == '') {
                // El campo $key está vacío
                return redirect()->back()->with('error', 'Por favor, complete todos los campos.');
            }
        }

        $clave_unica = $request->input('clave_unica');
        $examen =  $request->input('fecha_examen_aprobado');
        $promedio =  $request->input('promedio');
        $ingreso = $request->input('ano_ingreso');
        $opcionTitulacionSeleccionada = $request->input('opcion_titulacion');


        $opcionTitulacion = new OpcionTitulacionModel();
        $opcionTitulacion->fecha_solicitud = now()->format('Y-m-d');
        $opcionTitulacion->semestre = $this->dataAlumno[0]['semestre']; //<----Cambiar cuando se tenga el servicio web
        $opcionTitulacion->estado_solicitud = "ALTA";
        $opcionTitulacion->clave_unica = $clave_unica;
        $opcionTitulacion->id_opcion_titulacion = $opcionTitulacionSeleccionada;
        $opcionTitulacion->save();
        $newId = $opcionTitulacion->id_solicitud_OT;

        $dataSet = [
            [
                "clave_unica" => $clave_unica,
                "nombre_alumno" => "MARTINEZ LOPEZ IVAN",
            ]
        ];
        return redirect()->route('opTitulacionPDF.show', ['id' => $newId, 'dataSet' => $dataSet]);
    }

    public static function SacaDatosOpcionTitulacion()
    {
        $solicitudesOpcionTitulacion = OpcionTitulacionModel::all();
        //dd($solicitudes);
        return view('consultar_solicitudes', ['solicitudesOpcionTitulacion' => $solicitudesOpcionTitulacion]);
    }


    public function fetchOpcionTitulacion($idOrRequest = null, $origenVista)
    {
        if ($idOrRequest instanceof Request) {
            $clave_unica = $idOrRequest->input("clave_unica");
        } else {
            $clave_unica = $idOrRequest;
        }
        $registros = DB::table('solicitud_opcion_titulacion as OT')
            ->select('OT.id_solicitud_OT', 'COT.opcion_titulacion', 'OT.semestre', 'OT.clave_unica', 'OT.estado_solicitud', 'OT.fecha_solicitud')
            ->join('cat_opcion_titulacion as COT', 'OT.id_opcion_titulacion', '=', 'COT.id_opcion_titulacion')
            ->where('OT.clave_unica',  $clave_unica)
            ->get();

        $reg = $this->procesaInfo($registros);
        //dd($resultados);
        if ($origenVista == 'ALUMNOS') { //Éste metodo se llama desde la vista de alumnos

            return  $reg;
        }
        if ($registros->isEmpty()) {
            return null;
        }
        $html = view('tabla_consulta_opcion_titulacion', ['registros' => $registros])->render();
        return response()->json(['html' => $html]);
    }

    private function procesaInfo($dataMaterias)
    {

        //----Cuando se tenga disponible, se manda llamar al servicio web.---------

        foreach ($dataMaterias as $data) {
            $carbonFecha = \Carbon\Carbon::parse($data->fecha_solicitud);
            $fila = [
                'id_solicitud_OT' => $data->id_solicitud_OT,
                'opcion_titulacion' => $data->opcion_titulacion,
                'semestre' => $data->semestre,
                'clave_unica' => $data->clave_unica,
                'estado_solicitud' => $data->estado_solicitud,
                'fecha_solicitud' => $carbonFecha->day . '-' . $carbonFecha->month . '-' . $carbonFecha->year,


            ];
            $dataSet[] = $fila;
        }
        if (isset($dataSet))
            return $dataSet;
        else
            return null;
    }


    public function fetchAllOpcionTitulacion()
    {
        $registros = DB::table('solicitud_opcion_titulacion as OT')
            ->select('OT.id_solicitud_OT', 'COT.opcion_titulacion', 'OT.semestre', 'OT.clave_unica', 'estado_solicitud')
            ->join('cat_opcion_titulacion as COT', 'OT.id_opcion_titulacion', '=', 'COT.id_opcion_titulacion')
            ->get();

        if ($registros->isEmpty()) {
            return null;
        }
        //dd($registros);
        $html = view('tabla_consulta_opcion_titulacion', ['registros' => $registros])->render();
        return response()->json(['html' => $html]);
    }


    public function updateCancelar($id)
    {
        $d = OpcionTitulacionModel::find($id);
        // dd($d)
        $d->estado_solicitud = 'CANCELADA';
        $d->save();
        return redirect('/consultar');
    }

    public function updateAutorizar($id)
    {
        $d = OpcionTitulacionModel::find($id);
        // dd($d);
        $d->estado_solicitud = 'AUTORIZADA';
        $d->save();
        return redirect('/consultar');
    }

    public function mostrarDetallesOT($id)
    {
        $data = OpcionTitulacionModel::find($id);
        // dd($data);
        return view('/detallesOT', compact('data'));
    }
}
