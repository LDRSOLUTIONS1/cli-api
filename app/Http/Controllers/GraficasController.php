<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GraficasController extends Controller
{
    public function clientesPorTipo()
    {
        $data = Cliente::with('tipoCliente')
            ->select('tipo_cliente_id', DB::raw('count(*) as total'))
            ->groupBy('tipo_cliente_id')
            ->get()
            ->map(function ($item) {
                return [
                    'name' => $item->tipoCliente->nombre ?? 'Sin tipo',
                    'value' => $item->total,
                ];
            });

        return response()->json([
            'success' => true,
            'data' => $data,
        ]);
    }
}
