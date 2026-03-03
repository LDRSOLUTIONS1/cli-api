<?php

namespace App\Http\Controllers;

use App\Models\RegimenesFiscalesModel;
use Illuminate\Http\Request;

class RegimenesFiscalesController extends Controller
{
    public function index()
    {
        $regimenesFiscales = RegimenesFiscalesModel::select(
            'id',
            'c_regimen_fiscal',
            'descripcion',
            'persona_fisica',
            'persona_moral',
            'fecha_registro',
            'estado',
        )->where('estado', '!=', 0)->get();

        return response()->json($regimenesFiscales, 200);
    }
}
