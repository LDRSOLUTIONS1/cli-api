<?php

namespace App\Http\Controllers;

use App\Models\ModelosModel;
use Illuminate\Http\Request;

class ModelosController extends Controller
{

    public function index()
    {
        $modelos = ModelosModel::select(
            'id',
            'marca_id',
            'nombre',
            'fecha_registro',
            'estado'
        )->where('estado', '!=', 0)->get();

        return response()->json($modelos, 200);
    }

    public function store(Request $request)
    {
        $validated = $this->validateModelo($request);

        $modelo = ModelosModel::create($validated);

        return response()->json([
            'message' => 'Modelo creado correctamente',
            'data'    => $modelo
        ], 201);
    }

    public function show($id)
    {
        $modelo = ModelosModel::select(
            'id',
            'marca_id',
            'nombre',
            'fecha_registro',
            'estado'
        )
            ->where('id', $id)
            ->where('estado', '!=', 0)
            ->firstOrFail();

        return response()->json($modelo, 200);
    }

    public function update(Request $request, $id)
    {
        $modelo = ModelosModel::where('id', $id)
            ->where('estado', '!=', 0)
            ->firstOrFail();

        $validated = $this->validateModelo($request, $id);

        if ($modelo->clientes()->exists()) {
            return response()->json([
                'message' => 'No se puede actualizar el modelo porque tiene clientes asociados'
            ], 400);
        }

        $modelo->update($validated);

        return response()->json([
            'message' => 'Modelo actualizado correctamente',
            'data'    => $modelo
        ], 200);
    }

    public function destroy($id)
    {
        $modelo = ModelosModel::where('id', $id)
            ->where('estado', '!=', 0)
            ->firstOrFail();

        if ($modelo->clientes()->exists()) {
            return response()->json([
                'message' => 'No se puede eliminar el modelo porque tiene clientes asociados'
            ], 400);
        }

        $modelo->update(['estado' => 0]);

        return response()->json([
            'message' => 'Modelo eliminado correctamente'
        ], 200);
    }

    public function validateModelo(Request $request, $id = null)
    {
        return $request->validate(
            [
                'nombre' => 'required|string|max:255|unique:cli_regionales,nombre,' . $id,
            ],
            [
                'nombre.required' => 'El nombre es obligatorio',
                'nombre.max'      => 'El nombre no puede tener más de 255 caracteres',
                'nombre.unique'   => 'El nombre ya existe',
            ]
        );
    }
}
