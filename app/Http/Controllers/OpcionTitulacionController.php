<?php

namespace App\Http\Controllers;

use App\Models\CatOpcionTitulacionModel;
use App\Models\OpcionTitulacionModel;
use Illuminate\Http\Request;
use setasign\Fpdi\Fpdi;

class OpcionTitulacionController extends Controller
{
    protected $dataAlumno = [
        [
            "clave_unica" => 39999, //<-----Usar la clave única del servicio web
            "ultima_materia" => "23/10/2023",
            "promedio_ap" => "8.0",
            "semestre" => "2023-2024/I",
            "ingreso" => "2018",
        ],

    ];
    public function showTitulacionForm(Request $request)
    {
        $dataSet = $request->input('dataSet');
        //Se obtienen todas las opciones de titulación
        $opciones = CatOpcionTitulacionModel::all();

        //Se verifica si ya se tiene una solicitd de titulación ya registrada
        $exists = $this->opTitulacionRegister($dataSet);



        return view('formato_opcion_titulacion', ['dataSet' => $dataSet, 'dataAlumno' => $this->dataAlumno, 'exists' => $exists, 'opciones' => $opciones]); //<----Cambiar por servicio web
    }


    public function opcionTitulacionStore(Request $request)
    {
        $dataSet = $request->input('dataSet');
        $opcionTitulacionSeleccionada = $request->input('opcion_titulacion');



        //verificamos que no haya una solicitud activa en la base de datos
        $resultado = OpcionTitulacionModel::where('clave_unica', $dataSet[0]['clave_unica']) //<--- Cambiar por datos del servicio web
            ->where(function ($query) {
                $query->where('estado_solicitud', 'ALTA')
                    ->orWhere('estado_solicitud', 'AUTORIZADA');
            })
            ->first();

        if ($resultado != null && $resultado->count() > 0) {
            return back()->with('error', 'No tienes permitido hacer esta solicitud');
        }

        //El alumno no tiene ninguna solicitud registrada
        $opcionTitulacion = new OpcionTitulacionModel();
        $opcionTitulacion->fecha_solicitud = now()->format('Y-m-d');
        $opcionTitulacion->semestre = $this->dataAlumno[0]['semestre']; //<----Cambiar cuando se tenga el servicio web
        $opcionTitulacion->estado_solicitud = "ALTA";
        $opcionTitulacion->clave_unica = $dataSet[0]['clave_unica'];
        $opcionTitulacion->id_opcion_titulacion = $opcionTitulacionSeleccionada;
        $opcionTitulacion->save();
        session(['formularioOT_completado' => true]);
        $mensaje = "Solicitud registrada con éxito.";
        return redirect()->route('titulacion.show', ['dataSet' =>  $dataSet])->with('success', $mensaje);
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



        $dataSet = json_decode($request->input('dataSet'), true);
        //Se obtiene la información de la base de datos.

        $registro = OpcionTitulacionModel::where('clave_unica', $dataSet[0]['clave_unica'])
            ->where(function ($query) {
                $query->where('estado_solicitud', 'ALTA')
                    ->orWhere('estado_solicitud', 'AUTORIZADA');
            })
            ->first();

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
        $pdf->Write(0.1, $dataSet[0]['nombre_alumno']);
        $pdf->SetXY(177, 203.5);
        $pdf->Write(0.1, $dataSet[0]['clave_unica']);
        $pdf->SetXY(140, 208.9);
        $pdf->Write(0.1, $this->dataAlumno[0]['ultima_materia']);
        $pdf->SetXY(88, 213.5);
        $pdf->Write(0.1, $this->dataAlumno[0]['promedio_ap']);
        $pdf->SetXY(180, 213.5);
        $pdf->Write(0.1, $this->dataAlumno[0]['ingreso']);



        //$pdf->SetXY(60, 213);
        //$pdf->Write(0.1,"2023-2024/I");
        // Preview PDF
        $pdf->Output('I', "Demotest.pdf");

        // Download PDF
        //Download use D $pdf->Output(‘D’,”Demotest.pdf");

        // Save PDF to Particular path or project path

        $pdf->Output('F', "/new/yourfoldername/Demotest.pdf");
    }


    // función para mostrar los detalles desde la base de datos de la tabla de opción de titulación
    public function SacaDatosOpcionTitulacion()
    {
        $solicitudes = OpcionTitulacionModel::all();
        //dd($solicitudes);
        return view('rol', ['solicitudes' => $solicitudes]);
    }
}
