<?php

namespace App\Http\Controllers;

use App\Models\Genero;
use Illuminate\Http\Request;

class GeneroController extends Controller
{
    function getGeneros()
    {
        $result = Genero::all();
        return response()->json([
            'status' => 1,
            'generos' => $result
        ]);
    }
}
