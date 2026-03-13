<?php

namespace App\Http\Controllers;

use App\Models\Departamento;
use Illuminate\Http\Request;

class DepartamentosController extends Controller
{
    public function index()
    {
        $departamentos = Departamento::select(
            'id',
            'nombre',
            'descripcion',
            'fecha_registro',
            'estado',
        )->where('estado', '!=', 0)->get();

        return response()->json($departamentos, 200);
    }

    public function store(Request $request)
    {
        $validated = $this->validateDepartamento($request);

        $departamento = Departamento::create($validated);

        return response()->json([
            'message' => 'Departamento creado correctamente',
            'data'    => $departamento
        ], 201);
    }

    public function show($id)
    {
        $departamento = Departamento::select(
            'id',
            'nombre',
            'descripcion',
            'fecha_registro',
            'estado',
        )
            ->where('id', $id)
            ->where('estado', '!=', 0)
            ->firstOrFail();

        return response()->json($departamento, 200);
    }

    public function update(Request $request, $id)
    {
        $departamento = Departamento::where('id', $id)
            ->where('estado', '!=', 0)
            ->firstOrFail();

        $validated = $this->validateDepartamento($request, $id);

        if ($departamento->puestos()->exists()) {
            return response()->json([
                'message' => 'No se puede actualizar el departamento porque tiene puestos asociados'
            ], 400);
        }

        $departamento->update($validated);

        return response()->json([
            'message' => 'Departamento actualizado correctamente',
            'data'    => $departamento
        ], 200);
    }

    public function destroy($id)
    {
        $departamento = Departamento::where('id', $id)
            ->where('estado', '!=', 0)
            ->firstOrFail();

        if ($departamento->puestos()->exists()) {
            return response()->json([
                'message' => 'No se puede eliminar el departamento porque tiene puestos asociados'
            ], 400);
        }

        $departamento->update(['estado' => 0]);

        return response()->json([
            'message' => 'Departamento eliminado correctamente'

        ], 200);
    }

    public function  validateDepartamento(Request $request, $id = null)
    {
        return $request->validate(
            [
                'nombre' => 'required|string|max:255|unique:cli_departamentos,nombre,' . $id,
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
