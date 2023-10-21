<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MateriaUnicaModel extends Model
{
    use HasFactory;

    protected $table = 'solicitud_materia_unica';
    protected $primaryKey = 'id_solicitud_mu';
    public function sesion(){
        return $this->belongsTo(SesionHctcModel::class, 'id_sesion_hctc');
    }
}