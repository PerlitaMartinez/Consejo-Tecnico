<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $usuarios=DB::select('select * from user_c_s ');
       
        return view('Usuarios', compact('usuarios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $usuario =DB::insert("insert into user_c_s(rpe,nombre_usuario)values(?,?)",[
            $request->txtrpe,
            $request->txtnombre,
           
         ]);
         if($usuario == true)
         {
               return back()->with("correcto","Usuario agregado de forma exitosa");
         }else{
            return back()->with("incorrecto","No se pudo agregar usuario");
         }
    }

    /**
     * Store a newly created resource in storage.
     */
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
        try{
            $usuario=DB::update("update user_c_s set rpe=?,nombre=? where rpe=?",[
                $request->txtrpe,
                $request->txtnombre,
                $request->txtrpe

            ]);

        }catch(\Throwable $th){
            $usuario =0;
        }
        if($usuario == true)
         {
               return back()->with("correcto","Usuario modificado de forma exitosa");
         }else{
            return back()->with("incorrecto","No se pudo modificar usuario");
         }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
