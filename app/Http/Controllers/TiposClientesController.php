<?php

namespace App\Http\Controllers;

use App\Models\TiposClientesModel;
use Illuminate\Http\Request;

class TiposClientesController extends Controller
{
    public function index()
    {
        try {
            $tiposdeclientes = TiposClientesModel::select(
                'id',
                'nombre',
                'descripcion',
                'fecha_registro',
                'estado'
            )->get();

            return response()->json($tiposdeclientes, 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error al obtener los tipos de clientes',
                'mensaje' => $e->getMessage()
            ], 500);
        }
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        try {
            $tipocliente = TiposClientesModel::with([
                'clientes:id,tipo_cliente_id,nombre_comercial,razon_social,rfc,telefono,plaza'
            ])
                ->select('id', 'nombre', 'descripcion', 'fecha_registro', 'estado')
                ->where('id', $id)
                ->first();

            if (!$tipocliente) {
                return response()->json([
                    'error' => 'Tipo de cliente no encontrado'
                ], 404);
            }

            return response()->json($tipocliente, 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error al obtener el tipo de cliente',
                'mensaje' => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
