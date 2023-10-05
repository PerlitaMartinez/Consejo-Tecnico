<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SesionHctcModel extends Model
{
    use HasFactory;

    public function cargaMaxima(){
        return $this->hasMany(CargaMaximaModel::class);
    }
}
