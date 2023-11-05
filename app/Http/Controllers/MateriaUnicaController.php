<?php

namespace App\Http\Controllers;

use App\Models\MateriaUnicaModel;
use Illuminate\Http\Request;
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
        if(gettype($registered) === 'string') {
            
            if($registered == "true" || $registered == "1")
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
        $materia = $request->input('materia');
        $semestre = $request->input('semestre');
        $dataSet = $request->input('dataSet');
        $registered = $request->input('registered');

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

        $dataSet = json_decode($request->input('dataSet'), true);
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
        $pdf->SetXY(90, 130);
        $pdf->Write(0.1, $nombreMateriaEncontrado); //<-----Cambiar cuando se tenga el servicio web
        $pdf->SetXY(60, 183);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Write(0.1,  $dataSet[0]['nombre_alumno']);
        $pdf->SetXY(75, 193);
        $pdf->Write(0.1,  $dataSet[0]['clave_unica']);
        $pdf->SetXY(60, 203);
        $pdf->Write(0.1, "ING. EN COMPUTACION");//<-----Cambiar cuando se tenga el servicio web
        //$pdf->SetXY(60, 213);
        //$pdf->Write(0.1,"2023-2024/I");
        // Preview PDF
        session(['formularioMU_completado' => true]);
        //$pdf->Output('I', "Demotest.pdf");

        // Download PDF
        //Download use D $pdf->Output(‘D’,”Demotest.pdf");

        // Save PDF to Particular path or project path

        $pdf->Output('D','materia-Unica.pdf');
    }



    private function materiasNoReg($clave_unica)
    {
        //Obtenemos de Base de datos las materias registradas.

        $materiasRegistradas = MateriaUnicaModel::where('clave_unica', '=', $clave_unica)->get();
        if ($materiasRegistradas->isNotEmpty()) { //El alumno tiene materias registradas en la base de datos
            for ($i = 0; $i < count($this->materias); $i++) {
                $encontrada = false;
                foreach ($materiasRegistradas as $mat) {
                    if ($this->materias[$i]['cve_materia'] == $mat->clave_materia) {
                        $encontrada = true;
                    }
                }
                if (!$encontrada) {
                    $fila = [
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
        return null;
    }



    public function materiaUnicaDelete(Request $request)
    {
        $id = $request->input("id");
        $dataSet = json_decode($request->input('dataSet'), true);


        $registro = MateriaUnicaModel::find($id);

        if (!$registro) {
            // Si no se encuentra el registro, se envía un mensaje de error
            return response()->json(['message' => "Solicitud cancelada con éxito"])
                ->with('success', "Solicitud cancelada con éxito");
        }

        // Elimina el registro
        $registro->delete();

        // El registro se eliminó satisfactoriamente.
        return response()->json(['message' => true]);
    }



// función para mostrar los detalles desde la base de datos de la tabla de carga maxima
    public function SacaDatosMateriaUnica()
    {
        $solicitudes = MateriaUnicaModel::all();
        // dd($solicitudes);
        return view('rol', ['solicitudes' => $solicitudes]);
    }
}
