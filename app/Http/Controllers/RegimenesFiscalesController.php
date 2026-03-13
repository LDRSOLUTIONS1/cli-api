<?php

namespace App\Http\Controllers;

use App\Models\RegimenFiscal;

class RegimenesFiscalesController extends Controller
{
    public function getByTipoPersona($tipoPersona = null)
    {
        $query = RegimenFiscal::where('estado', 2);

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
