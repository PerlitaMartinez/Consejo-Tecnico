<?php

namespace App\Http\Controllers;

use App\Models\MateriaUnicaModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use setasign\Fpdi\Fpdi;


class MateriaUnicaController extends Controller
{

    protected $materias = [
        [
            "clave_unica" => 39999,
            "nombre_materia" => "CALCULO A",
            "cve_materia" => "2865",
            "semestre" => '2018-2019/II',
        ],
        [
            "clave_unica" => 39999,
            "nombre_materia" => "BASE DE DATOS",
            "cve_materia" => "3622",
            "semestre" => '2020-2021/II',
        ],
        [
            "clave_unica" => 39999,
            "nombre_materia" => "ESTRUCTURAS DE DATOS II",
            "cve_materia" => "9125",
            "semestre" => "2023-2024/I",
        ],

    ];


    public function showMateriaUnicaForm(Request $request)
    {
        //----------implementar la lógica llamando al servicio web método "materia_unica"-----------


        $dataSet = $request->input('dataSet');
        if (gettype($dataSet) === 'string') {
            $dataSet = json_decode($request->input('dataSet'), true);
        }
        $registered = $request->input('registered');
        //dd($registered);
        if (gettype($registered) === 'string') {

            if ($registered == "true" || $registered == "1")
                $registered = true;
            else
                $registered = false;
        }

        $materiaRegistrada = $request->input('materiaRegistrada');
        $id = $request->input('id');



        if ($registered) { //Hay que mostrar la vista para imprimir el formato

            return view('materiaUnica', ['dataSet' =>  $dataSet, 'materias' => $materiaRegistrada, 'registered' => $registered, 'id' => $id]);
        }

        //Verificamos las materias que ya están registradas
        $materiasNoReg = $this->materiasNoReg($dataSet[0]['clave_unica']);

        if ($materiasNoReg == null) { //Ninguna materia está registrada en base de datos
            return view('materiaUnica', ['dataSet' =>  $dataSet, 'materias' => $this->materias, 'registered' => $registered]);
        }
        if ($materiasNoReg == "registered") { //Todas las materias están registradas en base de datos
            return view('materiaUnica', ['dataSet' =>  $dataSet, 'materias' => "all", 'registered' => $registered]);
        }
        return view('materiaUnica', ['dataSet' =>  $dataSet, 'materias' =>  $materiasNoReg, 'registered' => $registered]); //Hay algunas materias registradas en base de datos
    }

    public function storeMateriaUnica(Request $request)
    {

        //Las materias se consultan aquí y no se envian desde el formulario
        $materia = $request->input('materia');
        $semestre = $request->input('semestre');
        $dataSet = $request->input('dataSet');
        if (gettype($dataSet) === 'string') {
            $dataSet = json_decode($request->input('dataSet'), true);
        }
        //dd($dataSet);
        $registered = $request->input('registered');
        $rol = $request->input('rol');
        //Buscamos la materia y el semestre en el dataSet del Servicio Web
        $encontrado = false;
        for ($i = 0; $i < count($this->materias) && !$encontrado; $i++) {
            if ($this->materias[$i]['nombre_materia'] == $materia && $this->materias[$i]['semestre'] == $semestre) {
                $encontrado = true;
                $fila[] = $this->materias[$i];
            }
        }
        //dd($resultado->count());

        //Guardamos en la base de datos
        $materiaUnica = new MateriaUnicaModel();
        $materiaUnica->fecha_solicitud = now()->format('Y-m-d');

        $materiaUnica->semestre = $fila[0]['semestre'];
        $materiaUnica->clave_unica = $dataSet[0]['clave_unica'];
        $materiaUnica->clave_materia = $fila[0]['cve_materia'];

        $materiaUnica->save();
        //Si se ha registrado la solicitud desde la pantalla de staff, colocaque la solicitud fue registrda con éxito
        if ($rol == 'RPE') {
            return response()->json(['id' => $materiaUnica->id_solicitud_mu], 200);
        }


        $nuevoID = $materiaUnica->id_solicitud_mu;

        $materias = [
            [
                "nombre_materia" => $fila[0]['nombre_materia'],
                'semestre' => $fila[0]['semestre'],
            ]

        ];

        $mensaje = "Solicitud Registrada con éxito.";
        return redirect()->route('materiaUnica.show', ['dataSet' =>  $dataSet, 'materiaRegistrada' => $materias, 'registered' => $registered, 'id' => $nuevoID])->with('success', $mensaje);
    }

    public function materiaUnicaPDFshow(Request $request)
    {


        $dataSet = $request->input('dataSet');
        $vistaAdmin = $request->input('vistaAdmin');

        if (gettype($dataSet) === 'string') {
            $dataSet = json_decode($request->input('dataSet'), true);
        } else {
            $dataSet = $request->input('dataSet');
        }
        if ($dataSet == null) {
            $claveUnica = $request->input('clave_unica');
            $ws = new WebServiceController();
            $dataSet = $ws->buscaAlumno($claveUnica);
        }
        $id = $request->input('id');
        //Verificamos en la base de datos que esté el registro
        $tupla = MateriaUnicaModel::find($id);
        if (!$tupla) {
            return back()->with('error', 'Solicitud no registrada.');
        }

        //buscamos el  nombre de la materia
        $nombreMateriaEncontrado = null;
        foreach ($this->materias as $materia) {
            if ($materia["cve_materia"] == $tupla->clave_materia) {
                $nombreMateriaEncontrado = $materia["nombre_materia"];

                break;
            }
        }

        //registramos la fecha de impresión
        $tupla->fecha_impresion = now();
        $tupla->save();

        //Generación del PDF
        $pdf = new Fpdi('P', 'mm', 'A4');
        // add a page
        $pdf->AddPage('P', 'A4');
        $pdf->SetFont('Arial', 'B', 10);

        // set the source file
        $path = public_path("SolicitudMateriaUnica.pdf");

        $pdf->setSourceFile($path);

        // import page 1
        $tplId = $pdf->importPage(1);

        // use the imported page and place it at point 10,10 with a width of 100 mm
        $pdf->useTemplate($tplId, 0, 0, null, null, true);

        //FECHA
        $pdf->SetXY(155, 58);
        $pdf->Write(0.1, $tupla->fecha_solicitud);

        $pdf->SetXY(90, 112);
        $pdf->Write(0.1, $tupla->semestre);
        if ($tupla->clave_materia != null) {
            $pdf->SetXY(90, 130);
            $pdf->Write(0.1, $nombreMateriaEncontrado); //<-----Cambiar cuando se tenga el servicio web
        } else {
            $pdf->SetXY(90, 130);
            $pdf->Write(0.1, 'CALCULO A');
        }

        $name = 'MARTINEZ LOPEZ IVAN';

        if (isset($dataSet))
            $name = $dataSet[0]['nombre_alumno'];

        $cu = '295969';
        if (isset($dataSet))
            $cu = $dataSet[0]['clave_unica'];


        $pdf->SetXY(60, 183);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Write(0.1, $name);
        $pdf->SetXY(75, 193);
        $pdf->Write(0.1,  $cu);
        $pdf->SetXY(60, 203);
        $pdf->Write(0.1, "ING. EN COMPUTACION"); //<-----Cambiar cuando se tenga el servicio web
        //$pdf->SetXY(60, 213);
        //$pdf->Write(0.1,"2023-2024/I");
        // Preview PDF
        //$pdf->Output('I', "Demotest.pdf");

        // Download PDF
        //Download use D $pdf->Output(‘D’,”Demotest.pdf");

        // Save PDF to Particular path or project path

        $pdf->Output('I', 'materia-Unica.pdf');
    }



    public function materiasNoReg($clave_unica)
    {
        //Obtenemos de Base de datos las materias registradas.

        $materiasRegistradas = MateriaUnicaModel::where('clave_unica', '=', $clave_unica)->get();
        if ($materiasRegistradas->isNotEmpty()) { //El alumno tiene materias registradas en la base de datos
            for ($i = 0; $i < count($this->materias); $i++) {
                $encontrada = false;
                foreach ($materiasRegistradas as $mat) {
                    if ($this->materias[$i]['cve_materia'] == $mat->clave_materia && ($mat->estado_solicitud == 'ALTA' || $mat->estado_solicitud == 'AUTORIZADA')) {
                        $encontrada = true;
                    }
                }
                if (!$encontrada) {
                    $fila = [
                        "clave_unica" => $clave_unica,
                        "nombre_materia" => $this->materias[$i]['nombre_materia'],
                        "semestre" => $this->materias[$i]["semestre"],
                    ];

                    $materias[] = $fila;
                }
            }
            if (isset($materias)) {
                return $materias;
            } else { //Todas las materias están registradas en base de datos
                return "registered";
            }
        }
        return null; //El alumno no tiene ninguna materia registrada
    }



    public function materiaUnicaCancel(Request $request)
    {
        $id = $request->input("id");
        $dataSet = json_decode($request->input('dataSet'), true);


        $registro = MateriaUnicaModel::find($id);




        if (!$registro) {
            // Si no se encuentra el registro, se envía un mensaje de error
            return response()->json(['message' => "No se encontro el registro"])
                ->with('success', "No se encontro el registro");
        }

        // Se cancela la solicitud
        $registro->estado_solicitud = "CANCELADA";
        $registro->save();
        //dd($registro);
        // El registro se eliminó satisfactoriamente.
        return response()->json(['message' => true]);
    }

    public function materiaUnicaShowAdministrador(Request $request)
    {
        return view('materiaUnica', ['admin' => true]);
    }

    public function storeMateriaUnicaAdmin(Request $request)
    {
        //Simulación servicio Web
        $materias = [
            [
                "clave_unica" => 39999,
                "nombre_materia" => "CALCULO A",
                "cve_materia" => "2865",
                "semestre" => '2018-2019/II',
                "nombre_alumno" => "MARTINEZ LOPEZ IVAN",
            ],
            [
                "clave_unica" => 39999,
                "nombre_materia" => "BASE DE DATOS",
                "cve_materia" => "3622",
                "semestre" => '2020-2021/II',
                "nombre_alumno" => "MARTINEZ LOPEZ IVAN",
            ],
            [
                "clave_unica" => 39999,
                "nombre_materia" => "ESTRUCTURAS DE DATOS II",
                "cve_materia" => "9125",
                "semestre" => "2023-2024/I",
                "nombre_alumno" => "MARTINEZ LOPEZ IVAN",
            ],

        ];

        $data = $request->all();


        //Verificamos que los campos no estén vacios
        foreach ($data as $key => $value) {
            if (empty($value)) {
                // El campo $key está vacío
                return redirect()->back()->with('error', 'Por favor, complete todos los campos.');
            }
        }


        $clave_unica = $request->input('clave_unica');
        $materia  = $request->input('materia');
        $semestre = $request->input('semestre');

        $materiaUnica = new MateriaUnicaModel();
        $materiaUnica->fecha_solicitud = now()->format('Y-m-d');

        $materiaUnica->semestre = $semestre;
        $materiaUnica->clave_unica = $clave_unica;
        //Colocar la clave de la materia cuando se tenga ---------------
        $materiaUnica->save();
        $nuevoID = $materiaUnica->id_solicitud_mu;
        $mensaje = "Solicitud Registrada con éxito.";

        $materias[0]['clave_unica'] = $clave_unica;
        $materias[0]['semestre'] =  $semestre;
        $materias[0]['materia'] = $materia;
        return redirect()->route('materiaUnicaPDF.show', ['dataSet' => $materias, 'id' => $nuevoID, 'vistaAdmin' => true]);
    }

    // función para mostrar los detalles desde la base de datos de la tabla de materia única
    public static function SacaDatosMateriaUnica()
    {
        $solicitudesMateriaUnica = MateriaUnicaModel::all();
        // dd($solicitudes);
        return view('consultar_solicitudes', ['solicitudesMateriaUnica' => $solicitudesMateriaUnica]);
    }


    //Regresa todos los registros de un alumno enviando la clave única
    public function fetchMateriaUnicaClave($requestOrClave, $origenVista = null)
    {
        if($requestOrClave instanceof Request) {
            $clave_unica = $requestOrClave->input('clave_unica');
            $solicitud = $requestOrClave->input('solicitud');
            $hctc = $requestOrClave->input('hctc');
        }
        else {
            $clave_unica = $requestOrClave;
        }

        $registros = [];
        if($clave_unica) {
            if($origenVista == 'ALUMNOS'){//Éste metodo se llama desde la vista de alumnos
                $registros = $this->fetchMateriaUnica($clave_unica);
                return  $registros;
            }//Este método se llama desde la vista de Usuarios con RPE para consulta de solicitudes
            $registros = $this->fetchMateriaUnica($clave_unica, $solicitud, $hctc);
        }
        //if ($idOrRequest instanceof Request) {
        //    $clave_unica = $idOrRequest->input("clave_unica");
        //}else{
        //    $clave_unica = $idOrRequest;
        //}
        //if($origenVista == 'ALUMNOS'){//Éste metodo se llama desde la vista de alumnos
        //    $registros = $this->fetchMateriaUnica($clave_unica);
        //    return  $registros;
        //}//Este método se llama desde la vista de Usuarios con RPE para consulta de solicitudes
        //$registros = $this->fetchMateriaUnica($clave_unica);
        $html = view('tabla_consulta_materia_unica', ['registros' => $registros])->render();
        return response()->json(['html' => $html, 'json' => $registros]);
    }

    private function fetchMateriaUnica($clave_Unica, $solicitud = null, $hctc = null)
    {
        $materias = [];
        if($solicitud != null || $hctc != null) {
            $consulta = MateriaUnicaModel::query();

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

            if($clave_Unica) {
                $consulta->where('clave_unica', $clave_Unica);
            }

            $materias = $consulta->get();
        }
        else
        {
            $materias = MateriaUnicaModel::select('id_solicitud_mu', 'clave_materia', 'semestre', 'clave_unica','estado_solicitud', 'fecha_solicitud')
                ->where('clave_unica', $clave_Unica)
                ->get();
        }

        if ($materias->isEmpty()) { //El alumno no tiene ninguna materia única registrada
            return null;
        }

        $infoMaterias = $this->procesaInfo($materias);

        return  $infoMaterias;
    }

    private function procesaInfo($dataMaterias)
    {
        $dataSet = null;
        //----Cuando se tenga disponible, se manda llamar al servicio web.---------
        foreach ($dataMaterias as $data) {
            $carbonFecha = Carbon::parse($data->fecha_solicitud);
            $fila = [
                'id_solicitud_mu' => $data->id_solicitud_mu,
                'materia' => $this->fetchNombreMateria($data->clave_materia),
                'semestre' => $data->semestre,
                'clave_unica' => $data->clave_unica,
                'estado_solicitud' => $data->estado_solicitud,
                'fecha_solicitud' => $carbonFecha->day . '-' . $carbonFecha->month . '-' . $carbonFecha->year,


            ];
            $dataSet[] = $fila;
        }
        return $dataSet;
    }


    private function fetchNombreMateria($clave_materia)
    {
        $encontrado = false;
        for ($i = 0; $i < count($this->materias) && !$encontrado; $i++) {
            if ($this->materias[$i]['cve_materia'] == $clave_materia) {
                $encontrado = true;
                $nombre_materia = $this->materias[$i]['nombre_materia'];
            }
        }
        return $nombre_materia;
    }


    public function fetchMateriaUnicaAllRegisters(Request $request)
    {
        //$materias = MateriaUnicaModel::select('id_solicitud_mu', 'clave_materia', 'semestre', 'clave_unica','estado_solicitud')->get();
        //if ($materias->isEmpty()) { //No hay solicitudes registradas de Materia Única
        //    return null;
        //}

        $solicitud = $request->input('solicitud');
        $hctc = $request->input('hctc');

        $consulta = MateriaUnicaModel::query();

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

        $materias = $consulta->get();

        $registros = $this->procesaInfo($materias);

        $html = view('tabla_consulta_materia_unica', ['registros' => $registros])->render();
        return response()->json(['html' => $html, 'json'=> $registros]);
    }


    public function updateCancelar($id){
        $d=MateriaUnicaModel::find($id);
        // dd($d);
        $d->estado_solicitud = 'CANCELADA';
        $d->save();
        return redirect('/consultar');
    }

    public function updateAutorizar($id)
    {
        $d = MateriaUnicaModel::find($id);
        // dd($d);
        $d->estado_solicitud = 'AUTORIZADA';
        $d->save();
        return redirect('/consultar');
    }

    public function mostrarDetallesMU($id)
    {
        $data = MateriaUnicaModel::find($id);
        // dd($data);
        return view('/detallesMU', compact('data'));
    }


    // funcion provisional para descargar pdf, con el servicio web se sacan los datos faltantes correctos
    public function materiaUnicaPDFshowPROVISIONAL(Request $request,$id)
    {
        // $dataSet = $request->input('dataSet');
        // $vistaAdmin = $request->input('vistaAdmin');

        // if (gettype($dataSet) === 'string') {
        //     $dataSet = json_decode($request->input('dataSet'), true);
        // } else {
        //     $dataSet = $request->input('dataSet');
        // }
        // $id = $request->input('id');

        //Verificamos en la base de datos que esté el registro
        $tupla = MateriaUnicaModel::find($id);
        if (!$tupla) {
            return back()->with('error', 'Solicitud no registrada.');
        }

        //buscamos el  nombre de la materia
        $nombreMateriaEncontrado = null;
        foreach ($this->materias as $materia) {
            if ($materia["cve_materia"] == $tupla->clave_materia) {
                $nombreMateriaEncontrado = $materia["nombre_materia"];

                break;
            }
        }

        //registramos la fecha de impresión
        $tupla->fecha_impresion = now();
        $tupla->save();

        //Generación del PDF
        $pdf = new Fpdi('P', 'mm', 'A4');
        // add a page
        $pdf->AddPage('P', 'A4');
        $pdf->SetFont('Arial', 'B', 10);

        // set the source file
        $path = public_path("SolicitudMateriaUnica.pdf");

        $pdf->setSourceFile($path);

        // import page 1
        $tplId = $pdf->importPage(1);

        // use the imported page and place it at point 10,10 with a width of 100 mm
        $pdf->useTemplate($tplId, 0, 0, null, null, true);

        //FECHA
        $pdf->SetXY(155, 58);
        $pdf->Write(0.1, $tupla->fecha_solicitud);

        $pdf->SetXY(90, 112);
        $pdf->Write(0.1, $tupla->semestre);
        if ($tupla->clave_materia != null) {
            $pdf->SetXY(90, 130);
            $pdf->Write(0.1, $nombreMateriaEncontrado); //<-----Cambiar cuando se tenga el servicio web
        } else {
            $pdf->SetXY(90, 130);
            $pdf->Write(0.1, 'CALCULO A');
        }

        $pdf->SetXY(60, 183);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Write(0.1,  'ALEJANDRO ESCAMILLA AMADOR');
        $pdf->SetXY(75, 193);
        $pdf->Write(0.1,  $tupla->clave_unica);
        $pdf->SetXY(60, 203);
        $pdf->Write(0.1, "ING. EN COMPUTACION"); //<-----Cambiar cuando se tenga el servicio web
        //$pdf->SetXY(60, 213);
        //$pdf->Write(0.1,"2023-2024/I");
        // Preview PDF
        //$pdf->Output('I', "Demotest.pdf");

        // Download PDF
        //Download use D $pdf->Output(‘D’,”Demotest.pdf");

        // Save PDF to Particular path or project path

        $pdf->Output('D', 'materia-Unica.pdf');

    }
}
