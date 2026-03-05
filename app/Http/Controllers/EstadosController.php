<?php

namespace App\Http\Controllers;

use App\Models\EstadoModel;
use Illuminate\Http\Request;

class EstadosController extends Controller
{
    public function index()
    {
        $estados = EstadoModel::where('estado', '!=', 0)->get();
        return response()->json($estados);
    }

    public function getByPais($pais_id)
    {
        $estados = EstadoModel::where('pais_id', $pais_id)
            ->where('estado', '!=', 0)
            ->get(['id', 'nombre']);

        return response()->json($estados);
    }
}
