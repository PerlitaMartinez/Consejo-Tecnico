<?php

namespace App\Http\Controllers;

use App\Models\MateriaUnicaModel;
use Illuminate\Http\Request;

class MateriaUnicaController extends Controller
{

    protected $materias = [
        [
            "clave_unica" => 295969,
            "nombre_materia" => "Cálculo A",
            "cve_materia" => "2865",
            "semestre" => '2018-2019/II',
        ],
        [
            "clave_unica" => 295969,
            "nombre_materia" => "Base de Datos",
            "cve_materia" => "3622",
            "semestre" => '2020-2021/II',
        ],
        [
            "clave_unica" => 295969,
            "nombre_materia" => "Estructuras de datos II",
            "cve_materia" => "9125",
            "semestre" => "2023-2024/I",
        ],

    ];

    protected $relizada = false;
    protected $registroExistente;
    public function showMateriaUnicaForm(Request $request)
    {
        //----------implementar la lógica llamando al servicio web método "materia_unica"-----------

        $this->registroExistente = MateriaUnicaModel::where('clave_unica', $this->materias[0]['clave_unica'])//<--- Cambiar por datos del servicio web
            ->where(function ($query) {
                $query->where('estado_solicitud', 'ALTA')
                    ->orWhere('estado_solicitud', 'AUTORIZADA');
            })
            ->first();

        $dataSet = $request->input('dataSet');
        return view('materiaUnica', ['dataSet' => $dataSet, 'materias' => $this->materias, 'registrado' =>  $this->registroExistente]);
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

        //verificamos que no esté guardado en la base de datos
        $resultado = MateriaUnicaModel::where('clave_unica', $this->materias[0]['clave_unica'])//<--- Cambiar por datos del servicio web
            ->where(function ($query) {
                $query->where('estado_solicitud', 'ALTA')
                    ->orWhere('estado_solicitud', 'AUTORIZADA');
            })
            ->get();
            //dd($resultado->count());

            if($resultado->count() > 0) {
                return back()->with('error', 'No tienes permitido hacer esta solicitud');
            }



        //Guardamos en la base de datos
        $materiaUnica = new MateriaUnicaModel();
        $materiaUnica->fecha_solicitud = now()->format('Y-m-d');

        $materiaUnica->semestre = $fila[0]['semestre'];
        $materiaUnica->clave_unica = $fila[0]['clave_unica'];
        $materiaUnica->clave_materia = $fila[0]['cve_materia'];

        $materiaUnica->save();
        $mensaje = "Solicitud registrada con éxito.\nSi necesita realizar modificaciones, puede cancelar esta solicitud y registrar una nueva.";
        return redirect()->route('materiaUnica.show', ['dataSet' => $dataSet, 'materias' => $this->materias, 'registrado' => $this->registroExistente])->with('success', $mensaje);
    }
}
