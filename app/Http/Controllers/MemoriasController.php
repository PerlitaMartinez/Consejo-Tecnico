<?php

namespace App\Http\Controllers;

use App\Models\Coasesor;
use Illuminate\Http\Request;
use App\Models\OpcionTitulacionModel;
use Illuminate\Support\Facades\DB;
use setasign\Fpdi\Fpdi;

class MemoriasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(request $request)
    {
        $id = $request->input('id');
        $temario =DB::insert("insert into temario(id_seccion,nombre_seccion,id_solicitud_OT)values(?,?,?)",[
            $request->txtorden,
            $request->txttitulo,
            $id

        ]);
        if($temario == true)
         {
               return back()->with("correcto","tema agregado de forma exitosa");
         }else{
            return back()->with("incorrecto","No se pudo agregar grupo");
         }
    }
    public function registroTm(){

    }
    public function showTM(Request $request){

        $dataSet = $request->input('dataSet');
        $exists = 0;
        $id = $request->input('id');
        $registro = OpcionTitulacionModel::find($id);
         $temarios = DB::select('select * from temario where id_solicitud_OT =?',[
            $id,
         ]);
         $tema = DB::select("select * from solicitud_registro_tema where id_solicitud_OT=$id");
         $coasesor = DB::select("select * from datos_coasesor where datos_coasesor.id_solicitud_OT= $id");
         $datosE = DB::select('select * from datos_empresa where id_solicitud_OT=?',[
            $id,
         ]);
         $datosA = DB::select('select * from datos_personales_alumno where id_solicitud_OT=?',[
            $id,
         ]);

        
         $dataSet = $request->input('dataSet');
         if (gettype($dataSet) === 'string') {
            $dataSet = json_decode($request->input('dataSet'), true);
        }

         if($tema == true)
         {
            $exists = 1;
            return view('registro_tema_temario_memorias',compact(
                'dataSet',
                'id',
                'exists',
                'tema',
                'datosE',
                'datosA',
                'coasesor',
                'temarios',
                'registro',
            ));
         }


        

        
    }
    

    /**
     * Store a newly created resource in storage.
     */
    public function agregaDatosP(Request $request){
         

         $id = $request->input('id');
         
         $datosE =DB::insert("insert into datos_empresa(
             id_solicitud_OT,
             nombre_empresa,
             calle_empresa,
             num_interior_empresa,
             num_exterior_empresa,
             colonia_empresa,
             cp_empresa,
             telefono_empresa,
             correo_empresa
 
         )
            values(?,?,?,?,?,?,?,?,?)",[
             $id,
             $request->txtnombreE,
             $request->txtcalleE,
             $request->txtnIE,
             $request->txtnEE,
             $request->txtcoloE,
             $request->txtcpE,
             $request->txtteleE,
             $request->txtemailEm
             
         ]);
        $datos =DB::insert("insert into datos_personales_alumno(
            id_solicitud_OT,
            calle_alumno,
            num_interior_alumno,
            num_exterior_alumno,
            colonia_alumno,
            cp_alumno,
            telefono_alumno,
            correo_alumno)
        values(?,?,?,?,?,?,?,?)",[
            $id,
            $request->txtcalle,
            $request->txtNi,
            $request->txtNo,
            $request->txtcolonia,
            $request->txtcp,
            $request->txttelefono,
            $request->txtemail

        ]);
        $fecha =  now()->format('Y-m-d');
        $tema =DB::insert("insert into solicitud_registro_tema(
                id_solicitud_OT,
                fecha_solicitud,
                tema)
               values(?,?,?)",[
                $id,
                $fecha,
                $request->txtTema
            ]);
            $coasesor =DB::insert("insert into datos_coasesor(
                id_solicitud_OT,
                nombre_coasesor)
               values(?,?)",[
                $id,
                $request->txtcoasesor
            ]);


        if($datos == true && $datosE == true && $tema == true && $coasesor == true){
         
               return back()->with("correcto","Datos agregados de forma exitosa");
         }else{
            return back()->with("incorrecto","No se pudo agregar grupo");
         }
    
    }
     
    public function agregaTema(Request $request){

            $id = $request->input("id");
            $fecha =  now()->format('Y-m-d');
            $tema =DB::insert("insert into solicitud_registro_tema(
                id_solicitud_OT,
                fecha_solicitud,
                tema)
               values(?,?,?)",[
                $id,
                $fecha,
                $request->txtTema
            ]);
            if($tema == true)
             {
               return back()->with("correcto","tema agregado de forma exitosa");
              }else{
               return back()->with("incorrecto","No se pudo agregar grupo");
              }

    }
    public function memoriasPdf(Request $request)
    {
        $dataSet = $request->input('dataSet');
        if (gettype($dataSet) === 'string') {
            $dataSet = json_decode($request->input('dataSet'), true);
        }else{
            $dataSet = $request->input('dataSet');
        }
        $id = $request->input('id');
        $datosA = DB::select("select * from datos_personales_alumno where id_solicitud_OT=$id");
        


        

        $fechaSolicitud = now()->format('Y-m-d'); 
        $carbonFecha = \Carbon\Carbon::parse($fechaSolicitud);
        $pdf = new Fpdi('P', 'mm', 'A4');
       



        // add a page
        $pdf->AddPage('P', 'A4');
        $pdf->SetFont('Arial', 'B', 10);
       
        

        // set the source file
        $path = public_path("FormaCTTL03-1.pdf");
      

        $pdf->setSourceFile($path);
       

        // import page 1
        $tplId = $pdf->importPage(1);
        $pdf->useTemplate($tplId, 0, 0, null, null, true);

      

        $pdf->SetXY(161, 47);
        $pdf->Write(0.1, $carbonFecha->day);
        $pdf->SetXY(175, 47);
        $pdf->Write(0.1, $carbonFecha->month);
        $pdf->SetXY(189, 47);
        $pdf->Write(0.1, $carbonFecha->year);
        
        $pdf->SetXY(60, 93);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Write(0.1, $dataSet[0]['nombre_alumno']);
        
        $pdf->SetXY(46, 102);
        $pdf->Write(0.1, 'Kepler');
        $pdf->SetXY(60, 102);
        $pdf->Write(0.1, 'Progreso');
        $pdf->SetXY(80, 102);
        $pdf->Write(0.1, 'No.Ext 375,Int 1');
        $pdf->SetXY(120, 102);
        $pdf->Write(0.1, '78370');

        $pdf->SetXY(50, 111);
        $pdf->Write(0.1, '4445553812');


        $pdf->SetXY(60, 121);
        $pdf->Write(0.1, 'Alberto Ramos Blanco');

        $pdf->SetXY(46, 132);
        $pdf->Write(0.1, "INGENIERIA EN COMPUTACION"); //<--Cambiar cuandoi tenga el servicio web

        $pdf->SetXY(60, 142);
        $pdf->Write(0.1, 'Ejemplo tema');

        $pdf->SetXY(60, 160);
        $pdf->Write(0.1, '1.-Ejemplo temario');
        $pdf->SetXY(60, 164);
        $pdf->Write(0.1, '2.-Ejemplo temario2');



        $pdf->SetXY(40, 247);
        $pdf->Write(0.1, 'Alberto Ramos Blanco');

        


        
        $pdf->Output('D', 'Memorias.pdf');
        

    }
    public function memoriasPdf2(Request $request)
    {
        $dataSet = $request->input('dataSet');
        if (gettype($dataSet) === 'string') {
            $dataSet = json_decode($request->input('dataSet'), true);
        }else{
            $dataSet = $request->input('dataSet');
        }
        $id = $request->input('id');
        $calle = DB::select('select * from datos_personales_alumno where id_solicitud_OT=?',[
            $id,
         ]);
        

        $fechaSolicitud = now()->format('Y-m-d'); 
        $carbonFecha = \Carbon\Carbon::parse($fechaSolicitud);
        $pdf = new Fpdi('P', 'mm', 'A4');
        



        // add a page
        $pdf->AddPage('P', 'A4');
        $pdf->SetFont('Arial', 'B', 10);
        
        

        // set the source file
        $path = public_path("solicitudMemori.pdf");
      
        $pdf->setSourceFile($path);
      

        // import page 1
        $tplId = $pdf->importPage(1);
        $pdf->useTemplate($tplId, 0, 0, null, null, true);

       


        $pdf->SetXY(161, 51);
        $pdf->Write(0.1, $carbonFecha->day);
        $pdf->SetXY(175, 51);
        $pdf->Write(0.1, $carbonFecha->month);
        $pdf->SetXY(189, 51);
        $pdf->Write(0.1, $carbonFecha->year);

        $pdf->SetXY(55, 90);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Write(0.1, $dataSet[0]['nombre_alumno']);

        $pdf->SetXY(56, 101);
        $pdf->Write(0.1, '2016');

       
        $pdf->SetXY(55, 111);
        $pdf->Write(0.1, 'INGENIERIA EN COMPUTACION');
        $pdf->SetXY(80, 126);
        $pdf->Write(0.1, 'Kepler');
        $pdf->SetXY(98, 126);
        $pdf->Write(0.1, 'Col. Progreso');
        $pdf->SetXY(130, 126);
        $pdf->Write(0.1, 'No. ext. 375');
        $pdf->SetXY(170, 126);
        $pdf->Write(0.1, '78370');

        $pdf->SetXY(80, 136);
        $pdf->Write(0.1, '4445553812');

        $pdf->SetXY(80, 148);
        $pdf->Write(0.1, 'Continental');

        $pdf->SetXY(55, 160);
        $pdf->Write(0.1, 'Carretera 57');

        

        $pdf->SetXY(100, 160);
        $pdf->Write(0.1, 'Col. Prados');

        $pdf->SetXY(150, 160);
        $pdf->Write(0.1, 'No. ext 576');

        $pdf->SetXY(58, 170);
        $pdf->Write(0.1, '8156789');
        $pdf->SetXY(160, 170);
        $pdf->Write(0.1, '5');

        $pdf->SetXY(48, 182);
        $pdf->Write(0.1, 'San Luis Potosi');


















        


         
      
        
        $pdf->Output('D', 'solicitud.pdf');
       

    }
    public function agregaDE(Request $request){

        $id = $request->input("id");
        $datosE =DB::insert("insert into datos_empresa(
            id_solicitud_OT,
            nombre_empresa,
            calle_empresa,
            num_interior_empresa,
            num_exterior_empresa,
            colonia_empresa,
            cp_empresa,
            telefono_empresa,
            correo_empresa

        )
           values(?,?,?,?,?,?,?,?,?)",[
            $id,
            $request->txtnombreE,
            $request->txtcalleE,
            $request->txtnIE,
            $request->txtnEE,
            $request->txtcoloE,
            $request->txtcpE,
            $request->txtteleE,
            $request->txtemailEm
            
        ]);
        if($datosE == true)
         {
           return back()->with("correcto","datos agregados de forma exitosa");
          }else{
           return back()->with("incorrecto","No se pudo agregar grupo");
          }


    }
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
