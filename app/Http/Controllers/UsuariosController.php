<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsuariosController extends Controller
{
    public function index()
    {
        $users = User::select(
            'id',
            'numcolaborador',
            'nombres',
            'apellidos',
            'telefono',
            'email_user',
            'rolid',
            'fecha_registro',
            'estado'
        )
            ->where('estado', '!=', 0)
            ->orderBy('id', 'desc')
            ->get();

        return response()->json($users, 200);
    }

    public function store(Request $request)
    {
        $validated = $this->validateUsuario($request);

        $validated['password'] = Hash::make('password');

        $user = User::create($validated);

        return response()->json([
            'message' => 'Usuario creado correctamente',
            'data'    => $user
        ], 201);
    }

    public function show($id)
    {
        $user = User::select(
            'id',
            'numcolaborador',
            'nombres',
            'apellidos',
            'telefono',
            'email_user',
            'rolid',
            'fecha_registro',
            'estado'
        )
            ->where('id', $id)
            ->where('estado', '!=', 0)
            ->firstOrFail();

        return response()->json($user, 200);
    }

    public function update(Request $request, $id)
    {
        $user = User::where('id', $id)
            ->where('estado', '!=', 0)
            ->firstOrFail();

        $validated = $this->validateUsuario($request, $id);

        if ($request->filled('password')) {
            $validated['password'] = Hash::make($request->password);
        }

        $user->update($validated);

        return response()->json([
            'message' => 'Usuario actualizado correctamente',
            'data'    => $user
        ], 200);
    }

    public function destroy($id)
    {
        $user = User::where('id', $id)
            ->where('estado', '!=', 0)
            ->firstOrFail();

        $user->update(['estado' => 0]);

        return response()->json([
            'message' => 'Usuario eliminado correctamente'
        ], 200);
    }

    private function validateUsuario(Request $request, $id = null)
    {
        return $request->validate(
            [
                'numcolaborador' => 'required|string|max:100|unique:cli_users,numcolaborador,' . $id,
                'nombres' => 'required|string|max:255',
                'apellidos' => 'required|string|max:255',
                'telefono' => 'nullable|string|max:100',
                'email_user' => 'required|string|email|max:255|unique:cli_users,email_user,' . $id,
                'rolid' => 'required|integer|in:1,2,3,4,5,6',
                'password' => 'nullable|string|min:6'
            ],
            [
                'numcolaborador.required' => 'El número de colaborador es obligatorio',
                'numcolaborador.unique' => 'Este número de colaborador ya está registrado',
                'nombres.required' => 'El nombre es obligatorio',
                'apellidos.required' => 'Los apellidos son obligatorios',
                'email_user.required' => 'El correo es obligatorio',
                'email_user.email' => 'El correo no tiene un formato válido',
                'email_user.unique' => 'Este correo ya está registrado',
                'rolid.required' => 'El rol es obligatorio',
                'rolid.in' => 'El rol seleccionado no es válido',
                'password.min' => 'La contraseña debe tener al menos 6 caracteres',
            ]
        );
    }

    public function asignarTipoCliente(Request $request, $userId)
    {
        $request->validate([
            'tipo_cliente_id' => 'required|exists:cli_tipos_clientes,id'
        ]);

        $user = User::findOrFail($userId);

        $user->tiposCliente()->sync([
            $request->tipo_cliente_id => [
                'fecha_registro' => now(),
                'estado' => 2
            ]
        ]);

        return response()->json([
            'message' => 'Tipo de cliente asignado correctamente',
            'user' => $user->load('tiposCliente')
        ]);
    }
}
