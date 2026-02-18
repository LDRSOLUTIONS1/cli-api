<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login($numcolaborador)
    {
        try {
            $user = User::where('numcolaborador', $numcolaborador)->first();

            if (!$user) {
                return response()->json([
                    'error' => 'Empleado no encontrado.'
                ], 404);
            }

            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
                'message' => 'Autenticación exitosa',
                'user' => $user,
                'token' => $token
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Error al autenticar empleado',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function user(Request $request)
    {
        $user = $request->user();
        return response()->json([
            'message' => 'Usuario autenticado',
            'user' => [
                'idusuario' => $user->idusuario,
                'numcolaborador' => $user->numcolaborador,
                'nombres' => $user->nombres,
                'apellidos' => $user->apellidos,
                'telefono' => $user->telefono,
                'email_user' => $user->email_user,
                'rolid' => $user->rolid,
            ]
        ], 200);
    }
}
