<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SesionHctcModel extends Model
{
    use HasFactory;
    
    protected $table = 'sesion_hctc';
    protected $primaryKey = 'id_sesion_hctc';
    

    public function materiaUnica(){
        return $this->hasMany(MateriaUnicaModel::class);
    }

    public function cargaMaxima(){
        return $this->hasMany(CargaMaximaModel::class);

    }

    public function opcionTitulacion(){
        return $this->hasMany(OpcionTitulacionModel::class);
    }
}
