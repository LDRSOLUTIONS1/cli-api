<?php

namespace App\Http\Controllers;

use App\Models\Regional;
use Illuminate\Http\Request;

class RegionalesController extends Controller
{
    public function index()
    {
        $regionales = Regional::select(
            'id',
            'nombre',
            'apellido_paterno',
            'apellido_materno',
            'correo_electronico',
            'telefono',
            'fecha_registro',
            'estado',
        )->where('estado', '!=', 0)->get();

        return response()->json($regionales, 200);
    }

    public function store(Request $request)
    {
        $validated = $this->validateRegional($request);

        $regional = Regional::create($validated);

        return response()->json([
            'message' => 'Regional creado correctamente',
            'data'    => $regional
        ], 201);
    }

    public function show($id)
    {
        $regional = Regional::select(
            'id',
            'nombre',
            'apellido_paterno',
            'apellido_materno',
            'correo_electronico',
            'telefono',
            'fecha_registro',
            'estado',
        )
            ->where('id', $id)
            ->where('estado', '!=', 0)
            ->firstOrFail();

        return response()->json($regional, 200);
    }

    public function update(Request $request, $id)
    {
        $regional = Regional::where('id', $id)
            ->where('estado', '!=', 0)
            ->firstOrFail();

        $validated = $this->validateRegional($request, $id);

        if ($regional->clientes()->exists()) {
            return response()->json([
                'message' => 'No se puede actualizar el regional porque tiene clientes asociados'
            ], 400);
        }

        $regional->update($validated);

        return response()->json([
            'message' => 'Regional actualizado correctamente',
            'data'    => $regional
        ], 200);
    }

    public function destroy($id)
    {
        $regional = Regional::where('id', $id)
            ->where('estado', '!=', 0)
            ->firstOrFail();

        if ($regional->clientes()->exists()) {
            return response()->json([
                'message' => 'No se puede eliminar el regional porque tiene clientes asociados'
            ], 400);
        }

        $regional->update(['estado' => 0]);

        return response()->json([
            'message' => 'Regional eliminado correctamente'
        ], 200);
    }

    public function validateRegional(Request $request, $id = null)
    {
        return $request->validate(
            [
                'nombre' => 'required|string|max:255|unique:cli_regionales,nombre,' . $id,
                'apellido_paterno' => 'required|string|max:255',
                'apellido_materno' => 'required|string|max:255',
            ],
            [
                'nombre.required' => 'El nombre es obligatorio',
                'nombre.max'      => 'El nombre no puede tener más de 255 caracteres',
                'nombre.unique'   => 'El nombre ya existe',
                'apellido_paterno.required' => 'El apellido paterno es obligatorio',
                'apellido_paterno.max'      => 'El apellido paterno no puede tener más de 255 caracteres',
                'apellido_materno.required' => 'El apellido materno es obligatorio',
                'apellido_materno.max'      => 'El apellido materno no puede tener más de 255 caracteres',
            ]
        );
    }
}
