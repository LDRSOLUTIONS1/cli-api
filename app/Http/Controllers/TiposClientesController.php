<?php

namespace App\Http\Controllers;

use App\Models\TiposClientesModel;
use Illuminate\Http\Request;

class TiposClientesController extends Controller
{
    public function index()
    {
        $tiposdeclientes = TiposClientesModel::select(
            'id',
            'nombre',
            'descripcion',
            'fecha_registro',
            'estado'
        )
            ->where('estado', '!=', 0)
            ->orderBy('id', 'desc')
            ->get();

        return response()->json($tiposdeclientes, 200);
    }

    public function store(Request $request)
    {
        $validated = $this->validateTipoCliente($request);

        $tipocliente = TiposClientesModel::create($validated);

        return response()->json([
            'message' => 'Tipo de cliente creado correctamente',
            'data'    => $tipocliente
        ], 201);
    }

    public function sshow($id)
    {
        $tipocliente = TiposClientesModel::with([
            'clientes' => function ($q) {
                $q->select(
                    'id',
                    'tipo_cliente_id',
                    'grupo_id',
                    'razon_social',
                    'tipo_persona',
                    'nombre_comercial',
                    'plaza',
                    'tipo_negocio',
                    'estado'
                );
            },
            'clientes.grupo:id,nombre',
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
    }

    public function show($id)
    {
        $tipocliente = TiposClientesModel::with([
            'clientes' => function ($q) {
                $q->select(
                    'id',
                    'tipo_cliente_id',
                    'grupo_id',
                    'razon_social',
                    'tipo_persona',
                    'nombre_comercial',
                    'plaza',
                    'tipo_negocio',
                    'estado'
                );
            },
            'clientes.grupo:id,nombre',

            'clientes.direcciones' => function ($q) {
                $q->select('id', 'distribuidor_id', 'estado_id');
            },
            'clientes.direcciones.estado' => function ($q) {
                $q->select('id', 'nombre', 'region_id');
            },
            'clientes.direcciones.estado.region' => function ($q) {
                $q->select('id', 'nombre');
            },
            'clientes.tipoCliente' => function ($q) {
                $q->select('id', 'nombre');
            },

        ])
            ->select('id', 'nombre', 'descripcion', 'fecha_registro', 'estado')
            ->where('id', $id)
            ->first();

        if (!$tipocliente) {
            return response()->json([
                'error' => 'Tipo de cliente no encontrado'
            ], 404);
        }

        $tipocliente->clientes = $tipocliente->clientes->map(function ($cliente) {

            $region = optional(
                optional(
                    optional($cliente->direcciones->first())->estado
                )->region
            )->nombre;

            return [
                'id' => $cliente->id,
                'tipo_cliente' => $cliente->tipoCliente->nombre ?? null,
                'grupo' => $cliente->grupo->nombre ?? null,
                'razon_social' => $cliente->razon_social,
                'tipo_persona' => $cliente->tipo_persona,
                'nombre_comercial' => $cliente->nombre_comercial,
                'plaza' => $cliente->plaza,
                'tipo_negocio' => $cliente->tipo_negocio,
                'estado' => $cliente->estado,
                'region' => $region,
            ];
        });

        return response()->json($tipocliente, 200);
    }

    public function update(Request $request, $id)
    {
        $tipocliente = TiposClientesModel::where('id', $id)
            ->where('estado', '!=', 0)
            ->firstOrFail();

        $validated = $this->validateTipoCliente($request, $id);

        if ($tipocliente->clientes()->exists()) {
            return response()->json([
                'message' => 'No se puede actualizar el tipo de cliente porque tiene clientes asociados'
            ], 400);
        }

        $tipocliente->update($validated);

        return response()->json([
            'message' => 'Tipo de cliente actualizado correctamente',
            'data'    => $tipocliente
        ], 200);
    }

    public function destroy($id)
    {
        $tipocliente = TiposClientesModel::where('id', $id)
            ->where('estado', '!=', 0)
            ->firstOrFail();


        if ($tipocliente->clientes()->exists()) {
            return response()->json([
                'message' => 'No se puede eliminar el tipo de cliente porque tiene clientes asociados'
            ], 400);
        }

        $tipocliente->update(['estado' => 0]);

        return response()->json([
            'message' => 'Tipo de cliente eliminado correctamente'
        ], 200);
    }

    private function validateTipoCliente(Request $request, $id = null)
    {
        return $request->validate(
            [
                'nombre' => 'required|string|max:255|unique:cli_tipos_cliente,nombre,' . $id,
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
