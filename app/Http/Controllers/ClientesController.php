<?php

namespace App\Http\Controllers;

use App\Models\ClientesModel;
use App\Models\ContactosModel;
use Illuminate\Http\Request;

class ClientesController extends Controller
{
    public function index()
    {
        $clientes = ClientesModel::with([
            'grupo:id,nombre',
            'direcciones' => function ($q) {
                $q->select('id', 'distribuidor_id', 'estado_id');
            },
            'direcciones.estado' => function ($q) {
                $q->select('id', 'nombre', 'region_id');
            },
            'direcciones.estado.region' => function ($q) {
                $q->select('id', 'nombre');
            }

        ])
            ->select(
                'id',
                'grupo_id',
                'razon_social',
                'tipo_persona',
                'nombre_comercial',
                'plaza',
                'tipo_negocio',
                'estado'
            )
            ->where('estado', '!=', 0)
            ->get()
            ->map(function ($cliente) {

                $region = optional(
                    optional(
                        optional($cliente->direcciones->first())->estado
                    )->region
                )->nombre;

                return [
                    'id' => $cliente->id,
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

        return response()->json($clientes, 200);
    }

    public function store(Request $request)
    {
        $validated = $this->validateCliente($request);

        $cliente = ClientesModel::create($validated);

        return response()->json([
            'message' => 'Cliente creado correctamente',
            'data'    => $cliente
        ], 201);
    }

    public function show($id)
    {

        $cliente = ClientesModel::with([
            'matriz' => function ($query) {
                $query->select(
                    'id',
                    'nombre_comercial',
                    'razon_social',
                );
            },
            'sucursales' => function ($query) {
                $query->select(
                    'id',
                    'matriz_id',
                    'nombre_comercial',
                    'razon_social',
                    'plaza',
                    'telefono',
                );
            },
            'regimenFiscal' => function ($query) {
                $query->select(
                    'id',
                    'c_regimen_fiscal',
                    'descripcion',
                    'persona_fisica',
                    'persona_moral'
                );
            },
            'grupo' => function ($query) {
                $query->select(
                    'id',
                    'nombre'
                );
            },
            'tipoCliente' => function ($query) {
                $query->select(
                    'id',
                    'nombre'
                );
            },
            'direcciones' => function ($query) {
                $query->select(
                    'id',
                    'distribuidor_id',
                    'tipo',
                    'calle',
                    'numero_ext',
                    'numero_int',
                    'colonia',
                    'codigo_postal',
                    'pais_id',
                    'estado_id',
                    'municipio_id',
                );
            },
            'direcciones.pais' => function ($q) {
                $q->select('id', 'nombre');
            },
            'direcciones.estado' => function ($q) {
                $q->select('id', 'nombre', 'region_id');
            },
            'direcciones.estado.region' => function ($q) {
                $q->select('id', 'nombre');
            },
            'direcciones.municipio' => function ($q) {
                $q->select('id', 'nombre');
            },
            'direccionesFiscales' => function ($query) {
                $query->select(
                    'id',
                    'distribuidor_id',
                    'tipo',
                    'calle',
                    'numero_ext',
                    'numero_int',
                    'colonia',
                    'codigo_postal',
                    'pais_id',
                    'estado_id',
                    'municipio_id',
                );
            },
            'direccionesFiscales.pais' => function ($q) {
                $q->select('id', 'nombre');
            },
            'direccionesFiscales.estado' => function ($q) {
                $q->select('id', 'nombre', 'region_id');
            },
            'direccionesFiscales.estado.region' => function ($q) {
                $q->select('id', 'nombre');
            },
            'direccionesFiscales.municipio' => function ($q) {
                $q->select('id', 'nombre');
            },
            'regionales',
            'modelos',
            'marcas',
        ])->findOrFail($id);

        if ($cliente->tipo_negocio === 'Matriz') {

            $ids = ClientesModel::where('matriz_id', $cliente->id)
                ->pluck('id')
                ->push($cliente->id);
        } else {
            $ids = collect([$cliente->id]);
        }

        $contactos = ContactosModel::select(
            'id',
            'distribuidor_id',
            'nombre',
            'correo',
            'extension',
            'telefono',
            'estatus',
            'fecha_registro',
            'puesto_id'
        )
            ->with([
                'puesto:id,nombre,departamento_id',
                'puesto.departamento:id,nombre',
                'distribuidor:id,nombre_comercial'
            ])
            ->whereIn('distribuidor_id', $ids)
            ->get();

        $cliente->contactos = $contactos;

        return response()->json($cliente, 200);
    }

    public function update(Request $request, $id)
    {
        $cliente = ClientesModel::where('id', $id)
            ->where('estado', '!=', 0)
            ->firstOrFail();

        $validated = $this->validateCliente($request, $id);

        $cliente->update($validated);

        return response()->json([
            'message' => 'Cliente actualizado correctamente',
            'data'    => $cliente
        ], 200);
    }

    public function destroy($id)
    {
        $cliente = ClientesModel::where('id', $id)
            ->where('estado', '!=', 0)
            ->firstOrFail();

        $cliente->update(['estado' => 0]);

        return response()->json([
            'message' => 'Cliente eliminado correctamente'
        ], 200);
    }

    public function validateCliente(Request $request, $id = null)
    {
        return $request->validate(
            [
                'matriz_id' => 'nullable|exists:cli_clientes,id',
                'distribuidor_id' => 'nullable|exists:cli_clientes,id',
                'grupo_id' => 'nullable|exists:cli_grupos,id',
                'tipo_cliente_id' => 'nullable|exists:cli_tipos_clientes,id',
                'regimen_fiscal_id' => 'nullable|exists:cat_regimenes_fiscales,id',
                'razon_social' => 'required|string|max:255',
                'tipo_persona' => 'required|in:F,M',
                'nombre_comercial' => 'required|string|max:255',
                'plaza' => 'nullable|string|max:255',
                'clasificacion' => 'nullable|string|max:255',
                'estatus' => 'required|in:Activo,Inactivo',
                'tipo_negocio' => 'required|in:Matriz,Sucursal,Distribuidor',
                'telefono' => 'nullable|string|max:20',
                'telefono_alt' => 'nullable|string|max:20',
            ],
            [
                'matriz_id.exists' => 'La matriz seleccionada no existe',
                'distribuidor_id.exists' => 'El distribuidor seleccionado no existe',
                'grupo_id.exists' => 'El grupo seleccionado no existe',
                'tipo_cliente_id.exists' => 'El tipo de cliente seleccionado no existe',
                'regimen_fiscal_id.exists' => 'El régimen fiscal seleccionado no existe',

            ]
        );
    }
}
