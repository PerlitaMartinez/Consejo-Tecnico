<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CargaMaximaModel extends Model
{
    use HasFactory;

    protected $table = 'solicitud_carga_maxima';

    protected $primaryKey = 'id_solicitud_cm';
    public function sesion(){
        return $this->belongsTo(SesionHctcModel::class, 'id_sesion_hctc');
    }
}
