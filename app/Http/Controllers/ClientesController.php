<?php

namespace App\Http\Controllers;

use App\Models\ClientesModel;
use Illuminate\Http\Request;

class ClientesController extends Controller
{
    public function index()
    {
        try {
            $clientes = ClientesModel::with(
                'matriz',
                'sucursales',
                'regimenFiscal',
                'grupo',
                'tipoCliente',
                'direcciones',
                'direcciones.pais',
                'direcciones.estado',
                'direcciones.estado.region',
                'direcciones.municipio',
                'direccionesFiscales',
                'direccionesFiscales.pais',
                'direccionesFiscales.estado',
                'direccionesFiscales.estado.region',
                'direccionesFiscales.municipio',
                'contactos',
                'contactos.puesto',
                'contactos.puesto.departamento',
                'regionales',
                'modelos',
                'marcas',
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
            $cliente = ClientesModel::with(
                'matriz',
                'sucursales',
                'regimenFiscal',
                'grupo',
                'tipoCliente',
                'direcciones',
                'direcciones.pais',
                'direcciones.estado',
                'direcciones.estado.region',
                'direcciones.municipio',
                'direccionesFiscales',
                'direccionesFiscales.pais',
                'direccionesFiscales.estado',
                'direccionesFiscales.estado.region',
                'direccionesFiscales.municipio',
                'contactos',
                'contactos.puesto',
                'contactos.puesto.departamento',
                'regionales',
                'modelos',
                'marcas'
            )->findOrFail($id);

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
