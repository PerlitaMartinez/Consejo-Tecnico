<?php

namespace App\Http\Controllers;

use App\Models\CargaMaximaModel;
use Illuminate\Http\Request;
use \setasign\Fpdi\FpdfTpl;
use setasign\Fpdi\Fpdi;




class PdfGeneratorController extends Controller
{
    //

    public function cargaMaximaGenerate() {

        $pdf = new Fpdi('P', 'mm', 'A4');
   
   
        // add a page
        $pdf->AddPage('P', 'A4');
        $pdf->SetFont('Arial','B',10);
    
        // set the source file
        $path = public_path("FormaSGCM01.pdf");
    
        $pdf->setSourceFile($path);
    
        // import page 1
        $tplId = $pdf->importPage(1);
         
        
    
        // use the imported page and place it at point 10,10 with a width of 100 mm
        $pdf->useTemplate($tplId, 0, 0, null, null, true);
    
        $pdf->SetXY(169, 52);
        $pdf->Write(0.1,"05");
        $pdf->SetXY(183, 52);
        $pdf->Write(0.1,"10");
        $pdf->SetXY(196, 52);
        $pdf->Write(0.1,"2023");
        $pdf->SetXY(146, 112);
        $pdf->Write(0.1,"X");
        $pdf->SetXY(146, 116.5);
        $pdf->Write(0.1,"X");
        $pdf->SetXY(47, 201);
        $pdf->SetFont('Arial','B',10);
        $pdf->Write(0.1,"IVAN MARTINEZ LOPEZ");
        $pdf->SetXY(47, 206);
        $pdf->Write(0.1,"295969");
        $pdf->SetXY(47, 210);
        $pdf->Write(0.1,"ING. EN COMPUTACION");
        $pdf->SetXY(62, 214.55);
        $pdf->Write(0.1,"2023-2024/I");
    // Preview PDF
        $pdf->Output('I',"Demotest.pdf");
    
        // Download PDF
    //Download use D $pdf->Output(‘D’,”Demotest.pdf");
    
    // Save PDF to Particular path or project path
    
      $pdf->Output('F',"/new/yourfoldername/Demotest.pdf");

        

 
 
   }

   public function materiaUnicaGenerate() {

    $pdf = new Fpdi('P', 'mm', 'A4');


    // add a page
    $pdf->AddPage('P', 'A4');
    $pdf->SetFont('Arial','B',10);

    // set the source file
    $path = public_path("SolicitudMateriaUnica.pdf");

    $pdf->setSourceFile($path);

    // import page 1
    $tplId = $pdf->importPage(1);
     
    

    // use the imported page and place it at point 10,10 with a width of 100 mm
    $pdf->useTemplate($tplId, 0, 0, null, null, true);

    $pdf->SetXY(140, 55);
    $pdf->Write(0.1,"05");
    $pdf->SetXY(147.5, 55);
    $pdf->Write(0.1,"/");
    $pdf->SetXY(155, 55);
    $pdf->Write(0.1,"10");
    $pdf->SetXY(162.5, 55);
    $pdf->Write(0.1,"/");
    $pdf->SetXY(170, 55);
    $pdf->Write(0.1,"2023");
    $pdf->SetXY(90, 112);
    $pdf->Write(0.1,"2024-2025/I");
    $pdf->SetXY(90, 130);
    $pdf->Write(0.1,"Fundamentos de compiladores");
    $pdf->SetXY(60, 183);
    $pdf->SetFont('Arial','B',10);
    $pdf->Write(0.1,"IVAN MARTINEZ LOPEZ");
    $pdf->SetXY(75, 193);
    $pdf->Write(0.1,"295969");
    $pdf->SetXY(60, 203);
    $pdf->Write(0.1,"ING. EN COMPUTACION");
    //$pdf->SetXY(60, 213);
    //$pdf->Write(0.1,"2023-2024/I");
// Preview PDF
    $pdf->Output('I',"Demotest.pdf");

    // Download PDF
//Download use D $pdf->Output(‘D’,”Demotest.pdf");

// Save PDF to Particular path or project path

  $pdf->Output('F',"/new/yourfoldername/Demotest.pdf");

   }

   public function opcionTitulacionGenerate() {

    $pdf = new Fpdi('P', 'mm', 'A4');


    // add a page
    $pdf->AddPage('P', 'A4');
    $pdf->SetFont('Arial','B',10);

    // set the source file
    $path = public_path("FormaCTTL01.pdf");

    $pdf->setSourceFile($path);

    // import page 1
    $tplId = $pdf->importPage(1);
     
    

    // use the imported page and place it at point 10,10 with a width of 100 mm
    $pdf->useTemplate($tplId, 0, 0, null, null, true);

    $pdf->SetXY(161, 55);
    $pdf->Write(0.1,"05");
    $pdf->SetXY(175, 55);
    $pdf->Write(0.1,"10");
    $pdf->SetXY(189, 55);
    $pdf->Write(0.1,"2023");
    $pdf->SetXY(90, 96);
    $pdf->Write(0.1,"EN COMPUTACION");
    $pdf->SetXY(26.5, 118);
    $pdf->Write(0.1,"X");
    $pdf->SetXY(60, 203);
    $pdf->SetFont('Arial','B',10);
    $pdf->Write(0.1,"IVAN MARTINEZ LOPEZ");
    $pdf->SetXY(177, 203);
    $pdf->Write(0.1,"295969");
    $pdf->SetXY(135, 208);
    $pdf->Write(0.1,"22 / 11 / 2022");
    $pdf->SetXY(88, 213);
    $pdf->Write(0.1,"8.0");
    $pdf->SetXY(180, 213);
    $pdf->Write(0.1,"8.0");
   
   
   
    //$pdf->SetXY(60, 213);
    //$pdf->Write(0.1,"2023-2024/I");
// Preview PDF
    $pdf->Output('I',"Demotest.pdf");

    // Download PDF
//Download use D $pdf->Output(‘D’,”Demotest.pdf");

// Save PDF to Particular path or project path

  $pdf->Output('F',"/new/yourfoldername/Demotest.pdf");


   }

   public function registroTemaGenerate() {


   
    $pdf = new Fpdi('P', 'mm', 'A4');


    // add a page
    $pdf->AddPage('P', 'A4');
    $pdf->SetFont('Arial','B',10);

    // set the source file
    $path = public_path("FormaCTTL02.pdf");

    $pdf->setSourceFile($path);

    // import page 1
    $tplId = $pdf->importPage(1);
     
    

    // use the imported page and place it at point 10,10 with a width of 100 mm
    $pdf->useTemplate($tplId, 0, 0, null, null, true);

    $pdf->SetXY(160, 51);
    $pdf->Write(0.1,"05");
    $pdf->SetXY(175, 51);
    $pdf->Write(0.1,"10");
    $pdf->SetXY(188, 51);
    $pdf->Write(0.1,"2023");
    $pdf->SetXY(75, 100);
    $pdf->SetFont('Arial','B',10);
    $pdf->Write(0.1,"MARTINEZ");
    $pdf->SetXY(122, 100);
    $pdf->Write(0.1,"LOPEZ");
    $pdf->SetXY(170, 100);
    $pdf->Write(0.1,"IVAN");
    $pdf->SetXY(75, 109.5);
    $pdf->Write(0.1,"Alvaro Obregon 64, Centro, 78300 San Luis, S.L.P.");
    $pdf->SetXY(70, 118);
    $pdf->Write(0.1,"4443269203");
    $pdf->SetXY(70, 127);
    $pdf->Write(0.1,"Desarrollo de la habilidad emprendedora en estudiantes normalistas ");
    $pdf->SetXY(30, 132);
    $pdf->Write(0.1,"mediante la metodologia de Aprendizaje Orientado a Proyectos");
    $pdf->SetXY(70, 149);
    $pdf->Write(0.1,"M.I. VITAL OCHOA OMAR");
    $pdf->SetXY(70, 158);
    $pdf->Write(0.1,"INGENIERIA EN COMPUTACION");
// Preview PDF
    $pdf->Output('I',"Demotest.pdf");

    // Download PDF
//Download use D $pdf->Output(‘D’,”Demotest.pdf");

// Save PDF to Particular path or project path

  $pdf->Output('F',"/new/yourfoldername/Demotest.pdf");
   }

   public function guardarDatos(Request $request)
   {
       // Valida los datos del formulario
       $request->validate([
           'fecha_solicitud' => 'required|date',
           'semestre' => 'required|string|max:15',
           'materias_reprobadas' => 'nullable|integer',
           'duracion_y_media' => 'nullable|integer',
           'fecha_impresion' => 'nullable|date',
           'fecha_hora_tutor' => 'nullable|date',
           'estado_solicitud' => 'nullable|string|max:15',
           'clave_unica' => 'nullable|integer',
           'rpe_tutor' => 'nullable|integer',
           'rpe_staff' => 'nullable|integer',
           'id_sesion_hctc' => 'nullable|integer',
       ]);
   
       // Crea una nueva instancia del modelo SolicitudCargaMaxima y asigna los valores del formulario
       $solicitud = new CargaMaximaModel();
       $solicitud->fecha_solicitud = now();
       $solicitud->semestre = "2023-2024/I";
       $solicitud->materias_reprobadas = 52;
       $solicitud->clave_unica = 295969;
       $solicitud->id_sesion_hctc = $request->input('id_sesion_hctc');
   
       // Guarda el registro en la base de datos
       $solicitud->save();
   
       // Redirige a una página de confirmación o a donde desees
       $this->cargaMaximaGenerate();
   }
}
