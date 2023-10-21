<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CatOpcionTitulacionModel extends Model
{
    use HasFactory;

    protected $table = 'cat_opcion_titulacion';

    protected $primaryKey = 'id_opcion_titulacion';
    public function opcionTitulacion(){
        return $this->hasMany(OpcionTitulacionModel::class);
    }
}
