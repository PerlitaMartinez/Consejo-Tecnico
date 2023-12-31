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
            "materias_reprobadas_semestre" => "SI",
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
        $dataSet = $request->input('dataSet');
        //verificamos que no haya una solicitud activa en la base de datos
        $resultado = CargaMaximaModel::where('clave_unica',  $dataSet[0]['clave_unica']) //<--- Cambiar por datos del servicio web
            ->where('estado_solicitud', '!=', 'FINALIZADO')
            ->first();


        if ($resultado != null && $resultado->count() > 0) {
            return back()->with('error', 'No tienes permitido hacer esta solicitud');
        }

        //Al alummo no tiene una solicitud activa y puede guardar en base de datos
        $cargaMaxima = new CargaMaximaModel();
        $cargaMaxima->fecha_solicitud = now()->format('Y-m-d');
        $cargaMaxima->semestre = $this->cargaMaximaRegister[0]['semestre']; //<---Cambiar con datos del servicio web
        $cargaMaxima->materias_reprobadas = ($this->cargaMaximaRegister[0]['materias_reprobadas_semestre'] == "SI") ? true : false; //<----Cambiar con datos del servicio web
        $cargaMaxima->duracion_y_media = ($this->cargaMaximaRegister[0]['duracion_y_media_semestre'] == "SI") ? true : false; //<----Cambiar con datos del servicio web
        $cargaMaxima->estado_solicitud = "ALTA";
        $cargaMaxima->clave_unica = $dataSet[0]['clave_unica']; //<--Cambiar con servicio web
        $cargaMaxima->save();
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
        $pdf->Write(0.1, $dataSet[0]['nombre_alumno']);
        $pdf->SetXY(47, 206);
        $pdf->Write(0.1, $dataSet[0]['clave_unica']);
        $pdf->SetXY(47, 210);
        $pdf->Write(0.1, "ING. EN COMPUTACION"); //Cambiar cuando se tenga el servicio web
        $pdf->SetXY(62, 214.55);
        $pdf->Write(0.1, $this->cargaMaximaRegister[0]['semestre']); //Cambiar cuando se tenga el servicio web
        // Preview PDF
        //$pdf->Output('I', "Demotest.pdf");

        // Download PDF
        //Download use D 
        $pdf->Output('D', "carga-maxima.pdf");

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

    public function cargaMaximaDelete(Request $request)
    {
        $id = $request->input("id");
        $dataSet = json_decode($request->input('dataSet'), true);


        $registro = CargaMaximaModel::find($id);

        if (!$registro) {
            // Si no se encuentra el registro, se envía un mensaje de error
            return response()->json(['message' => "No se encontró el registro"])
                ->with('error', "No se pudo cancelar la solicitud.");
        }

        // Elimina el registro
        $registro->delete();

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



    public function fetchCargaMaxima(Request $request)
    {
        $clave_unica = $request->input("clave_unica");
        $registros = CargaMaximaModel::select('id_solicitud_cm', 'materias_reprobadas', 'duracion_y_media', 'semestre', 'clave_unica','estado_solicitud')
            ->where('clave_unica', $clave_unica)
            ->get();

        if ($registros->isEmpty()) { //El alumno no tiene niguna solicitud de carga máxima registrada.
            return null;
        }


        $html = view('tabla_consulta_carga_maxima', ['registros' => $registros])->render();
        return response()->json(['html' => $html]);
    }


    public function fetchAllCargaMaxima()
    {
        $registros = CargaMaximaModel::select('id_solicitud_cm', 'materias_reprobadas', 'duracion_y_media', 'semestre', 'clave_unica','estado_solicitud')
            ->get();

        if ($registros->isEmpty()) { //No hay solicitudes registradas
            return null;
        }
        $html = view('tabla_consulta_carga_maxima', ['registros' => $registros])->render();
        return response()->json(['html' => $html]);
    }

    public function updateCancelar($id){
        $d=CargaMaximaModel::find($id);
        // dd($d)
        $d->estado_solicitud='CANCELADA';
        $d->save();
        return redirect('/consultar');
    }

    public function updateAutorizar($id){
        $d=CargaMaximaModel::find($id);
        // dd($d);
        $d->estado_solicitud='AUTORIZADA';
        $d->save();
        return redirect('/consultar');
    }

    public function mostrarDetallesCM($id){
        $data=CargaMaximaModel::find($id);
        // dd($data);
        return view('/detallesCM', compact('data'));
    }

}
