<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CatOpcionTitulacionModel extends Model
{
    use HasFactory;

    protected $table = 'cat_opcion_titulacion';

    protected $primaryKey = 'id_opcion_titulacion';
    public function opcionTitulacion() :HasMany
    {
        return $this->hasMany(OpcionTitulacionModel::class ,'id_opcion_titulacion','id_solicitud_OT');
    }
}
