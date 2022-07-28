<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoUsuario extends Model
{
    use HasFactory;
    protected $table = "TIPO_USUARIO";
    protected $id  = "ID_TIPO_USUARIO";
    public $timestaps = false;
}
