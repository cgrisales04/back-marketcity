<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genero extends Model
{
    use HasFactory;
    protected $table = "GENERO";
    protected $id  = "ID_GENERO";
    public $timestaps = false;
}