<?php

namespace App\Http\Controllers;

use App\Models\MateriaUnicaModel;
use Illuminate\Http\Request;
use setasign\Fpdi\Fpdi;


class MateriaUnicaController extends Controller
{

    protected $materias = [
        [
            "clave_unica" => 295969,
            "nombre_materia" => "CALCULO A",
            "cve_materia" => "2865",
            "semestre" => '2018-2019/II',
        ],
        [
            "clave_unica" => 295969,
            "nombre_materia" => "BASE DE DATOS",
            "cve_materia" => "3622",
            "semestre" => '2020-2021/II',
        ],
        [
            "clave_unica" => 295969,
            "nombre_materia" => "ESTRUCTURAS DE DATOS II",
            "cve_materia" => "9125",
            "semestre" => "2023-2024/I",
        ],

    ];


    public function showMateriaUnicaForm(Request $request)
    {
        //----------implementar la lógica llamando al servicio web método "materia_unica"-----------
        $dataSet = $request->input('dataSet');
        $registroExistente = MateriaUnicaModel::where('clave_unica',  $dataSet[0]['clave_unica']) //<--- Cambiar por datos del servicio web
            ->where(function ($query) {
                $query->where('estado_solicitud', 'ALTA')
                    ->orWhere('estado_solicitud', 'AUTORIZADA');
            })
            ->first();

        
        if ($registroExistente) {//ya hay un registro guardado en la base de datos
            $nombreMateriaEncontrado = null;
            foreach ($this->materias as $materia) {
                if ($materia["cve_materia"] == $registroExistente->clave_materia) {
                    $nombreMateriaEncontrado = $materia["nombre_materia"];

                    break; 
                }
            }

            //Creamos el arreglo con la materia ya registrada
            $register = [
                [
                    'nombre_materia' =>   $nombreMateriaEncontrado,
                    'semestre' => $registroExistente->semestre
                ],

            ];
            return view('materiaUnica', ['dataSet' =>  $dataSet, 'materias' => $this->materias, 'registrado' =>  $register]); //Ya hay una materia registrada en trámite
        }


        return view('materiaUnica', ['dataSet' =>  $dataSet, 'materias' => $this->materias, 'registrado' =>  $registroExistente]);
    }

    public function storeMateriaUnica(Request $request)
    {
        $materia = $request->input('materia');
        $semestre = $request->input('semestre');
        $dataSet = $request->input('dataSet');

        

        //Buscamos la materia y el semestre en el dataSet
        $encontrado = false;
        for ($i = 0; $i < count($this->materias) && !$encontrado; $i++) {
            if ($this->materias[$i]['nombre_materia'] == $materia && $this->materias[$i]['semestre'] == $semestre) {
                $encontrado = true;
                $fila[] = $this->materias[$i];
            }
        }
        ;
        //verificamos que no haya una solicitud activa en la base de datos
        $resultado = MateriaUnicaModel::where('clave_unica', $dataSet[0]['clave_unica']) //<--- Cambiar por datos del servicio web
            ->where(function ($query) {
                $query->where('estado_solicitud', 'ALTA')
                    ->orWhere('estado_solicitud', 'AUTORIZADA');
            })
            ->first();
        //dd($resultado->count());

        if ($resultado != null && $resultado->count() > 0) {
            return back()->with('error', 'No tienes permitido hacer esta solicitud');
        }

        //Guardamos en la base de datos
        $materiaUnica = new MateriaUnicaModel();
        $materiaUnica->fecha_solicitud = now()->format('Y-m-d');

        $materiaUnica->semestre = $fila[0]['semestre'];
        $materiaUnica->clave_unica = $dataSet[0]['clave_unica'];
        $materiaUnica->clave_materia = $fila[0]['cve_materia'];

        $materiaUnica->save();
        session(['formularioMU_completado' => true]);

        $mensaje =  "Solicitud registrada con éxito.\nSi necesita realizar modificaciones, cancele esta solicitud y registre una nueva."; 
        return redirect()->route('materiaUnica.show', ['dataSet' =>  $dataSet, 'materias' => $this->materias])->with('success', $mensaje);
    }

    public function materiaUnicaPDFshow(Request $request)
    {


        //Verificamos en la base de datos que esé el registro
        $tupla = MateriaUnicaModel::where('estado_solicitud', 'ALTA')
            ->orWhere('estado_solicitud', 'AUTORIZADA')
            ->first();
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


        $dataSet = json_decode($request->input('dataSet'), true);
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
        $pdf->Write(0.1, "ING. EN COMPUTACION");
        //$pdf->SetXY(60, 213);
        //$pdf->Write(0.1,"2023-2024/I");
        // Preview PDF
        session(['formularioMU_completado' => true]);
        $pdf->Output('I', "Demotest.pdf");

        // Download PDF
        //Download use D $pdf->Output(‘D’,”Demotest.pdf");

        // Save PDF to Particular path or project path

        $pdf->Output('F', "/new/yourfoldername/Demotest.pdf");
    }
}
