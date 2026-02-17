<?php

namespace App\Http\Controllers;

use App\Models\GruposModel;
use Illuminate\Http\Request;

class GruposController extends Controller
{
    public function index()
    {
        try {
            $grupos = GruposModel::select(
                'id',
                'codigo',
                'nombre',
                'descripcion',
                'fecha_registro',
                'estado',
            )->where('estado', '!=', 0)->get();

            return response()->json($grupos, 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error al obtener los grupos',
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
            $grupo = GruposModel::with([
                'clientes:id,grupo_id,nombre_comercial,razon_social,rfc,telefono,plaza'
            ])
                ->select('id', 'codigo', 'nombre', 'descripcion', 'fecha_registro', 'estado',)
                ->where('id', $id)
                ->first();

            if (!$grupo) {
                return response()->json([
                    'error' => 'Grupo no encontrado'
                ], 404);
            }

            return response()->json($grupo, 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error al obtener el grupo',
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
