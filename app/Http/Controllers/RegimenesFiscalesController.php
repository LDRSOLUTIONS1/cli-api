<?php

namespace App\Http\Controllers;

use App\Models\RegimenesFiscalesModel;
use Illuminate\Http\Request;

class RegimenesFiscalesController extends Controller
{
    public function getByTipoPersona($tipoPersona = null)
    {
        $query = RegimenesFiscalesModel::where('estado', 2);

        if ($tipoPersona == "1") {
            $query->where('persona_fisica', 'Sí');
        } elseif ($tipoPersona == "2") {
            $query->where('persona_moral', 'Sí');
        }

        $regimenes = $query
            ->orderBy('c_regimen_fiscal')
            ->get(['id', 'c_regimen_fiscal', 'descripcion']);

        return response()->json($regimenes);
    }
}
