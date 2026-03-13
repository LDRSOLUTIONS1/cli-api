<?php

namespace App\Http\Controllers;

use App\Models\Puesto;
use Illuminate\Http\Request;

class PuestosController extends Controller
{
    public function index()
    {
        $puestos = Puesto::with([
            'departamento:id,nombre'
        ])
            ->select(
                'id',
                'departamento_id',
                'nombre',
                'descripcion',
                'fecha_registro',
                'estado'
            )
            ->where('estado', '!=', 0)
            ->get()
            ->map(function ($puesto) {

                return [
                    'id' => $puesto->id,
                    'departamento' => $puesto->departamento?->nombre,
                    'nombre' => $puesto->nombre,
                    'descripcion' => $puesto->descripcion,
                    'fecha_registro' => $puesto->fecha_registro,
                    'estado' => $puesto->estado,
                ];
            });

        return response()->json($puestos, 200);
    }

    public function store(Request $request)
    {
        $validated = $this->validatePuesto($request);

        $puesto = Puesto::create($validated);

        return response()->json([
            'message' => 'Puesto creado correctamente',
            'data'    => $puesto
        ], 201);
    }

    public function show($id)
    {
        $puesto = Puesto::with('departamento:id,nombre as nombre_departamento')->select(
            'id',
            'departamento_id',
            'nombre',
            'descripcion',
            'fecha_registro',
            'estado',
        )
            ->where('id', $id)
            ->where('estado', '!=', 0)
            ->firstOrFail();

        return response()->json($puesto, 200);
    }

    public function update(Request $request, $id)
    {
        $puesto = Puesto::where('id', $id)
            ->where('estado', '!=', 0)
            ->firstOrFail();

        $validated = $this->validatePuesto($request, $id);

        if ($puesto->contactos()->exists()) {
            return response()->json([
                'message' => 'No se puede actualizar el puesto porque tiene contactos asociados'
            ], 400);
        }

        $puesto->update($validated);

        return response()->json([
            'message' => 'Puesto actualizado correctamente',
            'data'    => $puesto
        ], 200);
    }

    public function destroy($id)
    {
        $puesto = Puesto::where('id', $id)
            ->where('estado', '!=', 0)
            ->firstOrFail();

        if ($puesto->contactos()->exists()) {
            return response()->json([
                'message' => 'No se puede eliminar el puesto porque tiene contactos asociados'
            ], 400);
        }

        $puesto->update(['estado' => 0]);

        return response()->json([
            'message' => 'Puesto eliminado correctamente'
        ], 200);
    }

    public function validatePuesto(Request $request, $id = null)
    {
        return $request->validate(
            [
                'departamento_id' => 'required|exists:cli_departamentos,id',
                'nombre' => 'required|string|max:255|unique:cli_puestos,nombre,' . $id,
                'descripcion' => 'nullable|string|max:255',
            ],
            [
                'departamento_id.required' => 'El departamento es obligatorio',
                'departamento_id.exists' => 'El departamento no existe',
                'nombre.required' => 'El nombre es obligatorio',
                'nombre.unique' => 'El nombre ya existe',
            ]
        );
    }
}
