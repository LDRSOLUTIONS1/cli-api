<?php

namespace App\Http\Controllers;

use App\Models\ClientesModel;
use App\Models\ContactosModel;
use Illuminate\Http\Request;

class ClientesController extends Controller
{
    public function index()
    {
        try {
            $clientes = ClientesModel::select(
                'id',
                'tipo_persona',
                'nombre_fisica',
                'apellido_paterno',
                'apellido_materno',
                'fecha_nacimiento',
                'correo',
                'curp',
                'razon_social',
                'representante_legal',
                'domicilio_fiscal',
                'rfc',
                'nombre_comercial',
                'repve',
                'plaza',
                'clasificacion',
                'estatus',
                'tipo_negocio',
                'telefono',
                'telefono_alt',
                'fecha_registro',
                'estado'
            )->get();

            return response()->json($clientes, 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error al obtener los clientes',
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
        } catch (\Exception $e) {
            return response()->json([
                'error' => "Error al obtener el cliente con ID {$id}",
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
