<?php

namespace App\Http\Controllers;

use App\Models\MunicipioModel;
use Illuminate\Http\Request;

class MunicipiosController extends Controller
{
    public function index()
    {
        $municipios = MunicipioModel::where('estado', '!=', 0)->get();
        return response()->json($municipios);
    }

    public function getByEstado($estado_id)
    {
        $municipios = MunicipioModel::where('estado_id', $estado_id)
            ->where('estado', '!=', 0)
            ->get(['id', 'nombre']);

        return response()->json($municipios);
    }
}
