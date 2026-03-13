<?php

namespace App\Http\Controllers;

use App\Models\Estado;

class EstadosController extends Controller
{
    public function index()
    {
        $estados = Estado::where('estado', '!=', 0)->get();
        return response()->json($estados);
    }

    public function getByPais($pais_id)
    {
        $estados = Estado::where('pais_id', $pais_id)
            ->where('estado', '!=', 0)
            ->get(['id', 'nombre']);

        return response()->json($estados);
    }
}
