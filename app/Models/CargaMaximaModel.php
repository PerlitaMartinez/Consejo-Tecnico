<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CargaMaximaModel extends Model
{
    use HasFactory;
    public function sesion(){
        return $this->belongsTo(SesionHctcModel::class);
    }
}
