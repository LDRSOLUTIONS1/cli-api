<?php

namespace App\Http\Controllers;

use App\Models\ClientesModel;
use App\Models\ContactosModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

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

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'marca_id' => 'required|exists:cli_marcas,id',
            'tipo_cliente_id' => 'required|exists:cli_tipos_cliente,id',
            'tipo_persona' => 'required|in:1,2',
            'regimen_fiscal_id' => 'required|exists:cli_regimenes_fiscales,id',

            'nombre_fisica' => 'nullable|string|max:255',
            'apellido_paterno' => 'nullable|string|max:255',
            'apellido_materno' => 'nullable|string|max:255',
            'fecha_nacimiento' => 'nullable|date',
            'curp' => 'nullable|string|max:255',

            'representante_legal' => 'nullable|string|max:255',
            'domicilio_fiscal' => 'nullable|string|max:255',

            'correo' => 'required|email|max:255',

            'grupo_id' => 'required|exists:cli_grupos,id',

            'nombre_comercial' => 'required|string|max:255',
            'razon_social' => 'required|string|max:255',
            'rfc' => 'required|string|max:255',

            'repve' => 'required|string|max:255',
            'plaza' => 'required|string|max:255',
            'clasificacion' => 'required|string|max:255',

            'estatus' => 'required|in:Activo,Desarrollo,Inactivo',
            'tipo_negocio' => 'required|in:Matriz,Sucursal',

            'matriz_id' => 'nullable|exists:cli_distribuidores,id',

            'telefono' => 'required|string|max:20',
            'telefono_alt' => 'nullable|string|max:20',

            'modelo' => 'required|array',
            'modelo.*' => 'exists:cli_modelos,id',

            'regional' => 'required|array',
            'regional.*' => 'exists:cli_regionales,id',

            'direccion_principal' => 'required|array',
            'direccion_fiscal' => 'required|array',

        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        DB::beginTransaction();

        $cliente = ClientesModel::create([
            'marca_id' => $request->marca_id,
            'tipo_cliente_id' => $request->tipo_cliente_id,
            'tipo_persona' => $request->tipo_persona,
            'regimen_fiscal_id' => $request->regimen_fiscal_id,

            'nombre_fisica' => $request->nombre_fisica,
            'apellido_paterno' => $request->apellido_paterno,
            'apellido_materno' => $request->apellido_materno,
            'fecha_nacimiento' => $request->fecha_nacimiento,
            'curp' => $request->curp,

            'representante_legal' => $request->representante_legal,
            'domicilio_fiscal' => $request->domicilio_fiscal,

            'correo' => $request->correo,

            'grupo_id' => $request->grupo_id,

            'nombre_comercial' => $request->nombre_comercial,
            'razon_social' => $request->razon_social,
            'rfc' => $request->rfc,

            'repve' => $request->repve,
            'plaza' => $request->plaza,
            'clasificacion' => $request->clasificacion,

            'estatus' => $request->estatus,
            'tipo_negocio' => $request->tipo_negocio,

            'telefono' => $request->telefono,
            'telefono_alt' => $request->telefono_alt,

            'matriz_id' => $request->matriz_id,
        ]);

        // MODELOS
        $modelos = [];

        foreach ($request->modelo as $modelo) {
            $modelos[$modelo] = [
                'distribuidor_id' => $cliente->id
            ];
        }

        $cliente->modelos()->sync($modelos);

        // REGIONALES
        $cliente->regionales()->sync($request->regional);

        // DIRECCION PRINCIPAL
        $direccion = $request->direccion_principal;

        $cliente->direcciones()->create([
            'tipo' => $direccion['tipo'],
            'calle' => $direccion['calle'],
            'numero_ext' => $direccion['numero_ext'],
            'numero_int' => $direccion['numero_int'],
            'colonia' => $direccion['colonia'],
            'codigo_postal' => $direccion['codigo_postal'],
            'pais_id' => $direccion['pais_id'],
            'estado_id' => $direccion['estado_id'],
            'municipio_id' => $direccion['municipio_id'],
        ]);

        // DIRECCION FISCAL
        $fiscal = $request->direccion_fiscal;

        $cliente->direccionesFiscales()->create([
            'tipo' => $fiscal['tipo'],
            'calle' => $fiscal['calle'],
            'numero_ext' => $fiscal['numero_ext'],
            'numero_int' => $fiscal['numero_int'],
            'colonia' => $fiscal['colonia'],
            'codigo_postal' => $fiscal['codigo_postal'],
            'pais_id' => $fiscal['pais_id'],
            'estado_id' => $fiscal['estado_id'],
            'municipio_id' => $fiscal['municipio_id'],
        ]);

        DB::commit();

        return response()->json([
            'message' => 'Cliente creado correctamente',
            'data' => $cliente
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
                'marca_id' => 'required|exists:cli_marcas,id',
                'tipo_cliente_id' => 'required|exists:cli_tipos_cliente,id',
                'tipo_persona' => 'required|in:1,2',
                'regimen_fiscal_id' => 'required|exists:cli_regimenes_fiscales,id',

                'nombre_fisica' => 'nullable|string|max:255',
                'apellido_paterno' => 'nullable|string|max:255',
                'apellido_materno' => 'nullable|string|max:255',
                'fecha_nacimiento' => 'nullable|date',
                'curp' => 'nullable|string|max:255',

                'representante_legal' => 'nullable|string|max:255',
                'domicilio_fiscal' => 'nullable|string|max:255',

                'correo' => 'required|email|max:255',

                'grupo_id' => 'required|exists:cli_grupos,id',

                'nombre_comercial' => 'required|string|max:255',
                'razon_social' => 'required|string|max:255',
                'rfc' => 'required|string|max:255',

                'repve' => 'required|string|max:255',
                'plaza' => 'required|string|max:255',
                'clasificacion' => 'required|string|max:255',

                'estatus' => 'required|in:Activo,Desarrollo,Inactivo',
                'tipo_negocio' => 'required|in:Matriz,Sucursal',

                'matriz_id' => 'nullable|exists:cli_distribuidores,id',

                'telefono' => 'required|string|max:20',
                'telefono_alt' => 'nullable|string|max:20',

                'modelo' => 'required|array',
                'modelo.*' => 'exists:cli_modelos,id',

                'regional' => 'required|array',
                'regional.*' => 'exists:cli_regionales,id',

                'direccion_principal' => 'required|array',
                'direccion_fiscal' => 'required|array',
            ],
            [
                'marca_id.required' => 'La marca es obligatoria',
                'marca_id.exists' => 'La marca no existe',
                'tipo_cliente_id.required' => 'El tipo de cliente es obligatorio',
                'tipo_cliente_id.exists' => 'El tipo de cliente no existe',
                'tipo_persona.required' => 'El tipo de persona es obligatorio',
                'regimen_fiscal_id.required' => 'El regimen fiscal es obligatorio',
                'regimen_fiscal_id.exists' => 'El regimen fiscal no existe',

                'nombre_fisica.max' => 'El nombre no puede tener más de 255 caracteres',
                'apellido_paterno.max' => 'El apellido paterno no puede tener más de 255 caracteres',
                'apellido_materno.max' => 'El apellido materno no puede tener más de 255 caracteres',
                'curp.max' => 'La curp no puede tener más de 255 caracteres',

                'representante_legal.max' => 'El representante legal no puede tener más de 255 caracteres',
                'domicilio_fiscal.max' => 'El domicilio fiscal no puede tener más de 255 caracteres',

                'correo.required' => 'El correo es obligatorio',
                'correo.email' => 'El correo no es valido',
                'correo.max' => 'El correo no puede tener más de 255 caracteres',

                'grupo_id.required' => 'El grupo es obligatorio',
                'grupo_id.exists' => 'El grupo no existe',

                'nombre_comercial.required' => 'El nombre comercial es obligatorio',
                'nombre_comercial.max' => 'El nombre comercial no puede tener más de 255 caracteres',
                'razon_social.required' => 'La razon social es obligatoria',
                'razon_social.max' => 'La razon social no puede tener más de 255 caracteres',
                'rfc.required' => 'El rfc es obligatorio',
                'rfc.max' => 'El rfc no puede tener más de 255 caracteres',

                'repve.required' => 'El repve es obligatorio',
                'repve.max' => 'El repve no puede tener más de 255 caracteres',
                'plaza.required' => 'La plaza es obligatoria',
                'plaza.max' => 'La plaza no puede tener más de 255 caracteres',
                'clasificacion.required' => 'La clasificacion es obligatoria',
                'clasificacion.max' => 'La clasificacion no puede tener más de 255 caracteres',

                'estatus.required' => 'El estatus es obligatorio',
                'estatus.in' => 'El estatus no es valido',
                'tipo_negocio.required' => 'El tipo de negocio es obligatorio',
                'tipo_negocio.in' => 'El tipo de negocio no es valido',

                'matriz_id.exists' => 'La matriz no existe',

                'telefono.required' => 'El telefono es obligatorio',
                'telefono.max' => 'El telefono no puede tener más de 20 caracteres',
                'telefono_alt.max' => 'El telefono alternativo no puede tener más de 20 caracteres',

                'modelo.required' => 'El modelo es obligatorio',
                'regional.required' => 'La regional es obligatoria',

                'direccion_principal.required' => 'La direccion principal es obligatoria',
                'direccion_fiscal.required' => 'La direccion fiscal es obligatoria',
            ]
        );
    }
}
