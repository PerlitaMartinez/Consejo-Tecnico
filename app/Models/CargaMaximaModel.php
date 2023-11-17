<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CargaMaximaModel extends Model
{
    use HasFactory;

    protected $table = 'solicitud_carga_maxima';
    public $timestamps = false;

    protected $primaryKey = 'id_solicitud_cm';
    public function sesion(){
        return $this->belongsTo(SesionHctcModel::class, 'id_sesion_hctc');
    }

    //Scope que sirve para traer todos los registros con una determinada clave 
    public function scopeClave_Unica($query, $clave_unica)
    {
        return $query->where('clave_unica', $clave_unica);
    }
}
