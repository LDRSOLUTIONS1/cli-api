<?php

namespace App\Http\Controllers;

use App\Models\Contacto;
use Illuminate\Http\Request;

class ContactosController extends Controller
{
    public function index()
    {
        $contactos = Contacto::with([
            'cliente:id,nombre_comercial,razon_social',
            'puesto:id,nombre'
        ])
            ->select(
                'id',
                'distribuidor_id',
                'puesto_id',
                'nombre',
                'correo',
                'extension',
                'telefono',
                'estatus',
                'fecha_registro',
                'estado',
            )
            ->where('estado', '!=', 0)
            ->get()
            ->map(function ($contacto) {

                return [
                    'id' => $contacto->id,
                    'distribuidor' => $contacto->cliente?->nombre_comercial ?? $contacto->cliente?->razon_social,
                    'distribuidor_id' => $contacto->distribuidor_id,
                    'puesto' => $contacto->puesto?->nombre,
                    'nombre' => $contacto->nombre,
                    'correo' => $contacto->correo,
                    'extension' => $contacto->extension,
                    'telefono' => $contacto->telefono,
                    'estatus' => $contacto->estatus,
                    'fecha_registro' => $contacto->fecha_registro,
                    'estado' => $contacto->estado,
                ];
            });

        return response()->json($contactos, 200);
    }

    public function store(Request $request)
    {
        $validated = $this->validateContacto($request);

        $contacto = Contacto::create($validated);

        return response()->json([
            'message' => 'Contacto creado correctamente',
            'data'    => $contacto
        ], 201);
    }

    public function show($id)
    {
        $contacto = Contacto::with([
            'cliente:id,nombre_comercial',
            'puesto:id,nombre'
        ])
            ->select(
                'id',
                'distribuidor_id',
                'puesto_id',
                'nombre',
                'correo',
                'extension',
                'telefono',
                'estatus',
                'fecha_registro',
                'estado',
            )
            ->where('id', $id)
            ->where('estado', '!=', 0)
            ->firstOrFail();


        return response()->json($contacto, 200);
    }

    public function update(Request $request, $id)
    {
        $contacto = Contacto::where('id', $id)
            ->where('estado', '!=', 0)
            ->firstOrFail();

        $validated = $this->validateContacto($request, $id);

        $contacto->update($validated);

        return response()->json([
            'message' => 'Contacto actualizado correctamente',
            'data'    => $contacto
        ], 200);
    }

    public function destroy($id)
    {
        $contacto = Contacto::where('id', $id)
            ->where('estado', '!=', 0)
            ->firstOrFail();

        $contacto->update(['estado' => 0]);

        return response()->json([
            'message' => 'Contacto eliminado correctamente'
        ], 200);
    }

    public function  validateContacto(Request $request, $id = null)
    {
        return $request->validate(
            [
                'distribuidor_id' => 'required|exists:cli_clientes,id',
                'puesto_id' => 'required|exists:cli_puestos,id',
                'nombre' => 'required|string|max:255',
                'correo' => 'nullable|string|email|max:255',
                'extension' => 'nullable|string|max:255',
                'telefono' => 'nullable|string|max:255',
            ],
            [
                'distribuidor_id.required' => 'El distribuidor es obligatorio',
                'distribuidor_id.exists' => 'El distribuidor no existe',
                'puesto_id.required' => 'El puesto es obligatorio',
                'puesto_id.exists' => 'El puesto no existe',
                'nombre.required' => 'El nombre es obligatorio',
                'nombre.max'      => 'El nombre no puede tener más de 255 caracteres',
            ]
        );
    }
}
