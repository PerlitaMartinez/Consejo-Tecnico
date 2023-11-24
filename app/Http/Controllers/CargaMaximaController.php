<?php

namespace App\Http\Controllers;

use App\Models\CargaMaximaModel;
use Illuminate\Http\Request;
use setasign\Fpdi\Fpdi;

class CargaMaximaController extends Controller
{

    //----despues de que se tenga el servicio web, se eliminará este arreglo
    protected $cargaMaximaRegister = [
        [
            "clave_unica" => 39999, //<-----Usar la clave única del servicio web
            "materias_reprobadas_semestre" => "NO",
            "duracion_y_media_semestre" => "SI",
            "semestre" => "2023-2024/I",
        ],

    ];



    //Controlador para mostrar el formulario
    public function showCargaMaximaForm(Request $request)
    {
        //-----------------CUANDO SE TENGA EL SERVICIO WEB, COLOCAR LA LÓGICA PARA INSTANCIARLO---------------------


        //Se verifica primero si el alumno tiene una solicitud de Carga Máxima ya registrada
        $dataSet = $request->input('dataSet');
        $exists = $this->cargaMaximaRegister($dataSet);
        $id = $request->input('id');


        //dd($dataSet);
        return view('cargaMaxima', [
            'dataSet' => $dataSet,
            'duracion' => $this->cargaMaximaRegister[0]['duracion_y_media_semestre'],
            'matRep' => $this->cargaMaximaRegister[0]['materias_reprobadas_semestre'],
            'exists' => $exists,
            'semestre' => $this->cargaMaximaRegister[0]['semestre'],
            'id' => $id
        ]);
    }





    //Controlador para gaurdar en base de datos
    public function cargaMaximaStore(Request $request)
    {
        $dataSet = $request->has('dataSet') ? $request->input('dataSet') : null;
        $rol = $request->input('rol');
        if ($dataSet !== null && count($dataSet) > 0)
            $clave_unica = $dataSet[0]['clave_unica'];
        else {
            $clave_unica = 295969;
        }
        if ($rol != 'RPE') {
            //verificamos que no haya una solicitud activa en la base de datos
            $resultado = CargaMaximaModel::where('clave_unica', $dataSet[0]['clave_unica'])
                ->where(function ($query) {
                    $query->where('estado_solicitud', '!=', 'RESPUESTA')
                        ->Where('estado_solicitud', '!=', 'CANCELADA');
                })
                ->get();



            if ($resultado != null && $resultado->count() > 0) {
                return back()->with('error', 'No tienes permitido hacer esta solicitud');
            }
        }

        //Al alummo no tiene una solicitud activa y puede guardar en base de datos
        $cargaMaxima = new CargaMaximaModel();
        $cargaMaxima->fecha_solicitud = now()->format('Y-m-d');
        $cargaMaxima->semestre = $this->cargaMaximaRegister[0]['semestre']; //<---Cambiar con datos del servicio web
        $cargaMaxima->materias_reprobadas = ($this->cargaMaximaRegister[0]['materias_reprobadas_semestre'] == "SI") ? true : false; //<----Cambiar con datos del servicio web
        $cargaMaxima->duracion_y_media = ($this->cargaMaximaRegister[0]['duracion_y_media_semestre'] == "SI") ? true : false; //<----Cambiar con datos del servicio web
        $cargaMaxima->estado_solicitud = "ALTA";
        $cargaMaxima->clave_unica = $clave_unica; //<--Cambiar con servicio web
        $cargaMaxima->save();

        if ($rol == 'RPE') {
            return response()->json(['id' => $cargaMaxima->id_solicitud_cm], 200);
        }

        $newId = $cargaMaxima->id_solicitud_cm;
        //dd($newId);
        $mensaje = "Solicitud registrada con éxito.";
        return redirect()->route('cargaMaxima.show', ['dataSet' =>  $dataSet, 'id' => $newId])->with('success', $mensaje);
    }




    public function cargaMaximaPDFshow(Request $request)
    {

        $dataSet = $request->input('dataSet');
        if (gettype($dataSet) === 'string') {
            $dataSet = json_decode($request->input('dataSet'), true);
        } else {
            $dataSet = $request->input('dataSet');
        }
        $id = $request->input('id');

        $nombre = 'MARTINEZ LOPEZ IVAN';
        $clave = '295969';
        if (isset($dataSet) || $dataSet != null) {
            $nombre =  $dataSet[0]['nombre_alumno'];
            $clave = $dataSet[0]['clave_unica'];
        }

        //Se obtiene la información de la base de datos.
        $registro = CargaMaximaModel::find($id);

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
        $path = public_path("FormaSGCM01.pdf");

        $pdf->setSourceFile($path);

        // import page 1
        $tplId = $pdf->importPage(1);



        // use the imported page and place it at point 10,10 with a width of 100 mm
        $pdf->useTemplate($tplId, 0, 0, null, null, true);

        $pdf->SetXY(169, 52);
        $pdf->Write(0.1, $carbonFecha->day);
        $pdf->SetXY(183, 52);
        $pdf->Write(0.1, $carbonFecha->month);
        $pdf->SetXY(196, 52);
        $pdf->Write(0.1, $carbonFecha->year);
        if ($registro->materias_reprobadas) {
            $pdf->SetXY(146, 112);
            $pdf->Write(0.1, "X");
        }
        if ($registro->duracion_y_media) {
            $pdf->SetXY(146, 116.5);
            $pdf->Write(0.1, "X");
        }
        $pdf->SetXY(47, 201);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Write(0.1,  $nombre);
        $pdf->SetXY(47, 206);
        $pdf->Write(0.1, $clave);
        $pdf->SetXY(47, 210);
        $pdf->Write(0.1, "ING. EN COMPUTACION"); //Cambiar cuando se tenga el servicio web
        $pdf->SetXY(62, 214.55);
        $pdf->Write(0.1, $this->cargaMaximaRegister[0]['semestre']); //Cambiar cuando se tenga el servicio web
        // Preview PDF
        //$pdf->Output('I', "Demotest.pdf");

        // Download PDF
        //Download use D 
        $pdf->Output('I', "carga-maxima.pdf");

        // Save PDF to Particular path or project path

        //$pdf->Output('F', "/new/yourfoldername/Demotest.pdf");

    }


    protected function cargaMaximaRegister($dataSet)
    {
        $registro = CargaMaximaModel::where('clave_unica', $dataSet[0]['clave_unica']) //<--- Cambiar por datos del servicio web
            ->where(function ($query) {
                $query->where('estado_solicitud', 'ALTA')
                    ->orWhere('estado_solicitud', 'AUTORIZADA');
            })
            ->first();
        return $registro;
    }


    // función para mostrar los detalles desde la base de datos de la tabla de carga maxima
    public function SacaDatosCargaMaxima()
    {
        $solicitudesCargaMaxima = CargaMaximaModel::all();
        //dd($solicitudes);
        return view('consultar_solicitudes', ['solicitudesCargaMaxima' => $solicitudesCargaMaxima]);
    }

    public function cargaMaximaCancel(Request $request)
    {
        $id = $request->input("id");
        $dataSet = json_decode($request->input('dataSet'), true);


        $registro = CargaMaximaModel::find($id);

        if (!$registro) {
            // Si no se encuentra el registro, se envía un mensaje de error
            return response()->json(['message' => "No se encontró el registro"])
                ->with('error', "No se pudo cancelar la solicitud.");
        }

        // Se cancela la solicitud
        $registro->estado_solicitud = "CANCELADA";
        $registro->save();
        // El registro se eliminó satisfactoriamente.
        return response()->json(['message' => true]);
    }

    public function showCargaMaximaFormAdmin(Request $request)
    {
        return view('cargaMaxima', ['admin' => true]);
    }



    public function cargaMaximaStoreAdmin(Request $request)
    {

        $clave_unica = $request->input('clave_unica');

        //dd($clave_unica);
        $cargaMaxima = new CargaMaximaModel();
        $cargaMaxima->fecha_solicitud = now()->format('Y-m-d');
        $cargaMaxima->semestre = $this->cargaMaximaRegister[0]['semestre']; //<---Cambiar con datos del servicio web
        $cargaMaxima->materias_reprobadas = ($this->cargaMaximaRegister[0]['materias_reprobadas_semestre'] == "SI") ? true : false; //<----Cambiar con datos del servicio web
        $cargaMaxima->duracion_y_media = ($this->cargaMaximaRegister[0]['duracion_y_media_semestre'] == "SI") ? true : false; //<----Cambiar con datos del servicio web
        $cargaMaxima->estado_solicitud = "ALTA";
        $cargaMaxima->clave_unica = $clave_unica; //<--Cambiar con servicio web
        $cargaMaxima->save();
        $newId = $cargaMaxima->id_solicitud_cm;
        $dataSet = [
            [
                "clave_unica" => $clave_unica,
                "nombre_alumno" => "MARTINEZ LOPEZ IVAN",
            ]
        ];

        return redirect()->route('cargaMaximaPDF.show', ['id' => $newId, 'dataSet' => $dataSet]);
    }



    public function fetchCargaMaxima($requestOrClave, $origenVista = null)
    {
        $clave_unica = null;
        $solicitud = null;
        $hctc = null;
        if($requestOrClave instanceof Request) {
            $clave_unica = $requestOrClave->input('clave_unica');
            $solicitud = $requestOrClave->input('solicitud');
            $hctc = $requestOrClave->input('hctc');
        }
        else {
            $clave_unica = $requestOrClave;
        }

        $consulta = CargaMaximaModel::query();

        if ($hctc) {
            $fechaInicio = Carbon::parse($hctc);
            $fechaInicio = $fechaInicio->format('Y-m-d'); // Use format directly
            $fechaFinal = Carbon::parse($fechaInicio)->addDays(30);
            $fechaFinal = $fechaFinal->format('Y-m-d');
            $consulta->whereBetween('fecha_solicitud', [$fechaInicio, $fechaFinal]);
        }

        if($solicitud) {
            $consulta->where('estado_solicitud', $solicitud);
        }

        $aux = $consulta;

        if($clave_unica) {
            $consulta->where('clave_unica', $clave_unica);
        }

        $registros = $consulta->get();

        //if ($idOrRequest instanceof Request) {
        //    $clave_unica = $idOrRequest->input("clave_unica");
        //} else {
        //    $clave_unica = $idOrRequest;
        //}

        //$registros = CargaMaximaModel::select('id_solicitud_cm', 'materias_reprobadas', 'duracion_y_media', 'semestre', 'clave_unica', 'estado_solicitud', 'fecha_solicitud')
        //    ->where('clave_unica', $clave_unica)
        //    ->get();



        //if ($registros->isEmpty()) { //El alumno no tiene niguna solicitud de carga máxima registrada.
        //    return null;
        //}
        $reg = $this->procesaInfo($registros);
        if ($origenVista == 'ALUMNOS') { //Éste metodo se llama desde la vista de alumnos
            return  $reg;
        }


        $html = view('tabla_consulta_carga_maxima', ['registros' => $registros])->render();
        return response()->json(['html' => $html, 'json' => $registros]);
    }

    private function procesaInfo($dataMaterias)
    {

        //----Cuando se tenga disponible, se manda llamar al servicio web.---------
        $dataSet = null;
        foreach ($dataMaterias as $data) {
            $carbonFecha = \Carbon\Carbon::parse($data->fecha_solicitud);
            $fila = [
                'id_solicitud_cm' => $data->id_solicitud_cm,
                'materias_reprobadas' => $data->materias_reprobadas,
                'duracion_y_media' => $data->duracion_y_media,
                'semestre' => $data->semestre,
                'clave_unica' => $data->clave_unica,
                'estado_solicitud' => $data->estado_solicitud,
                'fecha_solicitud' => $carbonFecha->day . '-' . $carbonFecha->month . '-' . $carbonFecha->year,

            ];
            $dataSet[] = $fila;
        }
        return $dataSet;
    }


    public function fetchAllCargaMaxima(Request $request)
    {
        //$registros = CargaMaximaModel::select('id_solicitud_cm', 'materias_reprobadas', 'duracion_y_media', 'semestre', 'clave_unica', 'estado_solicitud')
        //    ->get();

        //if ($registros->isEmpty()) { //No hay solicitudes registradas
        //    return null;
        //}

        $clave_unica = $request->input('clave_unica');
        $solicitud = $request->input('solicitud');
        $hctc = $request->input('hctc');

        $consulta = CargaMaximaModel::query();

        if ($hctc) {
            $fechaInicio = Carbon::parse($hctc);
            $fechaInicio = $fechaInicio->format('Y-m-d'); // Use format directly
            $fechaFinal = Carbon::parse($fechaInicio)->addDays(30);
            $fechaFinal = $fechaFinal->format('Y-m-d');
            $consulta->whereBetween('fecha_solicitud', [$fechaInicio, $fechaFinal]);
        }

        if($solicitud) {
            $consulta->where('estado_solicitud', $solicitud);
        }

        if($clave_unica) {
            $consulta->where('clave_unica', $clave_unica);
        }

        $registros = $consulta->get();
        $html = view('tabla_consulta_carga_maxima', ['registros' => $registros])->render();
        return response()->json(['html' => $html, 'json' => $registros]);
    }

    public function updateCancelar($id)
    {
        $d = CargaMaximaModel::find($id);
        // dd($d)
        $d->estado_solicitud = 'CANCELADA';
        $d->save();
        return redirect('/consultar');
    }

    public function updateAutorizar($id)
    {
        $d = CargaMaximaModel::find($id);
        // dd($d);
        $d->estado_solicitud = 'AUTORIZADA';
        $d->save();
        return redirect('/consultar');
    }

    public function mostrarDetallesCM($id)
    {
        $data = CargaMaximaModel::find($id);
        // dd($data);
        return view('/detallesCM', compact('data'));
    }



    // funcion provisional para descargar pdf, con el servicio web se sacan los datos faltantes correctos
    public function cargaMaximaPDFshowPROVISIONAL(Request $request,$id)
    {

        // $dataSet = $request->input('dataSet');
        // if (gettype($dataSet) === 'string') {
        //     $dataSet = json_decode($request->input('dataSet'), true);
        // } else {
        //     $dataSet = $request->input('dataSet');
        // }
        // $id = $request->input('id');

        //Se obtiene la información de la base de datos.
        $registro = CargaMaximaModel::find($id);

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
        $path = public_path("FormaSGCM01.pdf");

        $pdf->setSourceFile($path);

        // import page 1
        $tplId = $pdf->importPage(1);



        // use the imported page and place it at point 10,10 with a width of 100 mm
        $pdf->useTemplate($tplId, 0, 0, null, null, true);

        $pdf->SetXY(169, 52);
        $pdf->Write(0.1, $carbonFecha->day);
        $pdf->SetXY(183, 52);
        $pdf->Write(0.1, $carbonFecha->month);
        $pdf->SetXY(196, 52);
        $pdf->Write(0.1, $carbonFecha->year);
        if ($registro->materias_reprobadas) {
            $pdf->SetXY(146, 112);
            $pdf->Write(0.1, "X");
        }
        if ($registro->duracion_y_media) {
            $pdf->SetXY(146, 116.5);
            $pdf->Write(0.1, "X");
        }
        $pdf->SetXY(47, 201);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Write(0.1, 'ALEJANDRO ESCAMILLA AMADOR');
        $pdf->SetXY(47, 206);
        $pdf->Write(0.1, $registro->clave_unica);
        $pdf->SetXY(47, 210);
        $pdf->Write(0.1, "ING. EN COMPUTACION"); //Cambiar cuando se tenga el servicio web
        $pdf->SetXY(62, 214.55);
        $pdf->Write(0.1, $registro->semestre); //Cambiar cuando se tenga el servicio web
        // Preview PDF
        //$pdf->Output('I', "Demotest.pdf");

        // Download PDF
        //Download use D
        $pdf->Output('D', "carga-maxima.pdf");

        // Save PDF to Particular path or project path

        //$pdf->Output('F', "/new/yourfoldername/Demotest.pdf");

    }
}
