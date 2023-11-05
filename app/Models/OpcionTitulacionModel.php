<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OpcionTitulacionModel extends Model
{
    use HasFactory;

    protected $table = 'solicitud_opcion_titulacion';
    protected $primaryKey = 'id_solicitud_OT';

    public $timestamps = false;


    public function sesion() :BelongsTo{
        return $this->belongsTo(SesionHctcModel::class, 'id_sesion_hctc');
    }

    public function catOpcionTitulacion() :BelongsTo
    { 
        return $this->belongsTo(CatOpcionTitulacionModel::class, 'id_solicitud_OT', 'id_opcion_titulacion');
    }
}
