<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Temario_autorizacion extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'temario_autorizacion';
    protected $primaryKey = 'id_temario';
}
