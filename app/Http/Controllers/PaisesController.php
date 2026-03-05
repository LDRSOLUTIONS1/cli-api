<?php

namespace App\Http\Controllers;

use App\Models\PaisModel;
use Illuminate\Http\Request;

class PaisesController extends Controller
{
    public function index()
    {
        $paises = PaisModel::where('estado', '!=', 0)->get();
        return response()->json($paises);
    }


}
