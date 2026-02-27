<?php

namespace App\Http\Controllers;

use App\Models\GruposModel;
use Illuminate\Http\Request;

class GruposController extends Controller
{
    public function index()
    {
        $grupos = GruposModel::select(
            'id',
            'codigo',
            'nombre',
            'descripcion',
            'fecha_registro',
            'estado',
        )->where('estado', '!=', 0)->get();

        return response()->json($grupos, 200);
    }

    public function store(Request $request)
    {
        $validated = $this->validateGrupo($request);

        $grupo = GruposModel::create($validated);

        return response()->json([
            'message' => 'Grupo creado correctamente',
            'data'    => $grupo
        ], 201);
    }

    public function show($id)
    {

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
    }

    public function update(Request $request, $id)
    {
        $grupo = GruposModel::where('id', $id)
            ->where('estado', '!=', 0)
            ->firstOrFail();

        $validated = $this->validateGrupo($request, $id);

        if ($grupo->clientes()->exists()) {
            return response()->json([
                'message' => 'No se puede actualizar el grupo porque tiene clientes asociados'
            ], 400);
        }

        $grupo->update($validated);

        return response()->json([
            'message' => 'Grupo actualizado correctamente',
            'data'    => $grupo
        ], 200);
    }

    public function destroy($id)
    {
        $grupo = GruposModel::where('id', $id)
            ->where('estado', '!=', 0)
            ->firstOrFail();

        if ($grupo->clientes()->exists()) {
            return response()->json([
                'message' => 'No se puede eliminar el grupo porque tiene clientes asociados'
            ], 400);
        }

        $grupo->update(['estado' => 0]);

        return response()->json([
            'message' => 'Grupo eliminado correctamente'
        ], 200);
    }

    private function validateGrupo(Request $request, $id = null)
    {
        return $request->validate(
            [
                'codigo' => 'nullable|string|max:100',
                'nombre' => 'required|string|max:255|unique:cli_grupos,nombre,' . $id,
                'descripcion' => 'nullable|string|max:255',
            ],
            [
                'nombre.required' => 'El nombre es obligatorio',
                'nombre.max'      => 'El nombre no puede tener más de 255 caracteres',
                'nombre.unique'   => 'El nombre ya existe',
            ]
        );
    }
}
