<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Contacto;
use App\Http\Requests\ClienteRequest;
use Illuminate\Support\Facades\DB;

class ClientesController extends Controller
{
    public function index()
    {
        $clientes = Cliente::with([
            'grupo:id,nombre',
            'direcciones' => function ($q) {
                $q->select('id', 'distribuidor_id', 'estado_id');
            },
            'direcciones.estado' => function ($q) {
                $q->select('id', 'nombre', 'region_id');
            },
            'direcciones.estado.region' => function ($q) {
                $q->select('id', 'nombre');
            },
            'tipoCliente' => function ($q) {
                $q->select('id', 'nombre');
            },


        ])
            ->select(
                'id',
                'tipo_cliente_id',
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

        return response()->json($clientes, 200);
    }

    public function store(ClienteRequest $request)
    {
        $validated = $request->validated();

        DB::beginTransaction();

        try {
            $cliente = Cliente::create($validated);

            //MODELOS
            if ($request->filled('modelo')) {
                $cliente->modelos()->sync($request->modelo);
            }

            //REGIONALES
            if ($request->filled('regional')) {
                $cliente->regionales()->sync($request->regional);
            }

            //MARCAS
            if ($request->filled('marca_id')) {
                $cliente->marcas()->sync([$request->marca_id]);
            }

            //DIRECCION PRINCIPAL
            if ($request->filled('direccion_principal')) {
                $direccion = $request->direccion_principal;
                $direccion['distribuidor_id'] = $cliente->id;
                $cliente->direcciones()->create($direccion);
            }

            //DIRECCION FISCAL
            if ($request->filled('direccion_fiscal')) {
                $direccionFiscal = $request->direccion_fiscal;
                $direccionFiscal['distribuidor_id'] = $cliente->id;
                $cliente->direccionesFiscales()->create($direccionFiscal);
            }

            DB::commit();

            return response()->json([
                'message' => 'Cliente creado correctamente',
                'data' => $cliente
            ], 201);
        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([
                'message' => 'Error al crear cliente',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function show($id)
    {

        $cliente = Cliente::with([
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

            $ids = Cliente::where('matriz_id', $cliente->id)
                ->pluck('id')
                ->push($cliente->id);
        } else {
            $ids = collect([$cliente->id]);
        }

        $contactos = Contacto::select(
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

    public function clientesEditar($id)
    {
        $cliente = Cliente::with([
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

            $ids = Cliente::where('matriz_id', $cliente->id)
                ->pluck('id')
                ->push($cliente->id);
        } else {
            $ids = collect([$cliente->id]);
        }

        $contactos = Contacto::select(
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

    public function update(ClienteRequest $request, $id)
    {
        DB::beginTransaction();

        try {
            $cliente = Cliente::findOrFail($id);

            $cliente->update($request->validated());

            //MODELOS
            if ($request->has('modelo')) {
                $cliente->modelos()->sync($request->modelo);
            }

            //REGIONALES
            if ($request->has('regional')) {
                $cliente->regionales()->sync($request->regional);
            }

            //MARCAS
            if ($request->filled('marca_id')) {
                $cliente->marcas()->sync([$request->marca_id]);
            }

            //DIRECCION PRINCIPAL
            if ($request->filled('direccion_principal')) {
                $direccion = $request->direccion_principal;
                $cliente->direcciones()->updateOrCreate(
                    ['distribuidor_id' => $cliente->id],
                    $direccion
                );
            }

            //DIRECCION FISCAL
            if ($request->filled('direccion_fiscal')) {
                $direccionFiscal = $request->direccion_fiscal;
                $cliente->direccionesFiscales()->updateOrCreate(
                    ['distribuidor_id' => $cliente->id],
                    $direccionFiscal
                );
            }

            DB::commit();

            return response()->json([
                'message' => 'Cliente actualizado correctamente',
                'data' => $cliente
            ]);
        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([
                'message' => 'Error al actualizar cliente',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        $cliente = Cliente::where('id', $id)
            ->where('estado', '!=', 0)
            ->firstOrFail();

        $cliente->update(['estado' => 0]);

        return response()->json([
            'message' => 'Cliente eliminado correctamente'
        ], 200);
    }
}
