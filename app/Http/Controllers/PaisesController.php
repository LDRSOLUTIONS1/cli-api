<?php

namespace App\Http\Controllers;

use App\Models\Pais;

class PaisesController extends Controller
{
    public function index()
    {
        $paises = Pais::where('estado', '!=', 0)->get();
        return response()->json($paises);
    }


}
