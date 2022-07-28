<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoIdentificacion extends Model
{
    use HasFactory;
    protected $table = "TIPO_IDENTIFICACION";
    protected $id  = "ID_IDENTIFICACION";
    public $timestaps = false;
}
