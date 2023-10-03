<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \setasign\Fpdi\FpdfTpl;
use setasign\Fpdi\Fpdi;




class DemoController extends Controller
{
    //

    public function Addtopdf() {

        $pdf = new Fpdi('P', 'cm', 'A4');
   
   
       // add a page
       $pdf->AddPage();
       $pdf->SetFont('Arial','B',100);
   
       // set the source file
       $path = public_path("FormaSGCM01.pdf");
   
       $pdf->setSourceFile($path);
   
       // import page 1
       $tplId = $pdf->importPage(1);
        
       
   
       // use the imported page and place it at point 10,10 with a width of 100 mm
       $pdf->useTemplate($tplId, null, null, null, 210, true);
   
       $pdf->SetXY(127, 40);
       $pdf->Write(0.1,"02");
       $pdf->SetXY(137.5, 40);
       $pdf->Write(0.1,"10");
       $pdf->SetXY(147, 40);
       $pdf->Write(0.1,"2023");
       $pdf->SetXY(110.4, 87.5);
       $pdf->Write(0.1,"X");
       $pdf->SetXY(110.4, 84.2);
       $pdf->Write(0.1,"X");
       $pdf->SetXY(35, 151);
       $pdf->SetFont('Arial','B',90);
       $pdf->Write(0.1,"NOMBRE APELLIDO_1 APELLIDO_2");
       $pdf->SetXY(32, 154.5);
       $pdf->Write(0.1,"295969");
       $pdf->SetXY(36, 157.8);
       $pdf->Write(0.1,"ING. EN COMPUTACION");
       $pdf->SetXY(47, 161.3);
       $pdf->Write(0.1,"2023-2024/I");
   // Preview PDF
       $pdf->Output('I',"Demotest.pdf");
   
       // Download PDF
   //Download use D $pdf->Output(‘D’,”Demotest.pdf");
   
   // Save PDF to Particular path or project path
   
     $pdf->Output('F',"/new/yourfoldername/Demotest.pdf");
   
   }
}
