<?php

namespace App\Http\Controllers;

use App\Models\TipoUsuario;
use Illuminate\Http\Request;

class TipoUsuarioController extends Controller
{
    function getTipoUsuarios()
    {
        $result = TipoUsuario::all();
        return response()->json([
            'status' => 1,
            'tipoUsuario' => $result
        ]);
    }
}
