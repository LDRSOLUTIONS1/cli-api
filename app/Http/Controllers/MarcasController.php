<?php

namespace App\Http\Controllers;

use App\Models\MarcasModel;
use Illuminate\Http\Request;

class MarcasController extends Controller
{
    public function index()
    {
        $marcas = MarcasModel::select(
            'id',
            'nombre',
            'codigo',
            'fecha_registro',
            'estado'
        )
            ->where('estado', '!=', 0)
            ->orderBy('id', 'desc')
            ->get();

        return response()->json($marcas, 200);
    }

    public function store(Request $request)
    {
        $validated = $this->validateMarca($request);

        $marca = MarcasModel::create($validated);

        return response()->json([
            'message' => 'Marca creada correctamente',
            'data'    => $marca
        ], 201);
    }

    public function show($id)
    {
        $marca = MarcasModel::select(
            'id',
            'nombre',
            'codigo',
            'fecha_registro',
            'estado'
        )
            ->where('id', $id)
            ->where('estado', '!=', 0)
            ->firstOrFail();

        return response()->json($marca, 200);
    }

    public function update(Request $request, $id)
    {
        $marca = MarcasModel::where('id', $id)
            ->where('estado', '!=', 0)
            ->firstOrFail();

        $validated = $this->validateMarca($request, $id);

        $marca->update($validated);

        return response()->json([
            'message' => 'Marca actualizada correctamente',
            'data'    => $marca
        ], 200);
    }

    public function destroy($id)
    {
        $marca = MarcasModel::where('id', $id)
            ->where('estado', '!=', 0)
            ->firstOrFail();

        $marca->update(['estado' => 0]);

        return response()->json([
            'message' => 'Marca eliminada correctamente'
        ], 200);
    }

    private function validateMarca(Request $request, $id = null)
    {
        return $request->validate(
            [
                'nombre' => 'required|string|max:255|unique:cli_marcas,nombre,' . $id,
                'codigo' => 'nullable|string|max:100',
            ],
            [
                'nombre.required' => 'El nombre es obligatorio',
                'nombre.max'      => 'El nombre no puede tener más de 255 caracteres',
                'nombre.unique'   => 'El nombre ya existe',
            ]
        );
    }
}
