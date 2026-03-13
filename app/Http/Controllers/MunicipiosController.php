<?php

namespace App\Http\Controllers;

use App\Models\Municipio;

class MunicipiosController extends Controller
{
    public function index()
    {
        $municipios = Municipio::where('estado', '!=', 0)->get();
        return response()->json($municipios);
    }

    public function getByEstado($estado_id)
    {
        $municipios = Municipio::where('estado_id', $estado_id)
            ->where('estado', '!=', 0)
            ->get(['id', 'nombre']);

        return response()->json($municipios);
    }
}
