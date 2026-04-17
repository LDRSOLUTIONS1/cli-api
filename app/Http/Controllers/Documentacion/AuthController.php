<?php

namespace App\Http\Controllers\Documentacion;

/**
 * @OA\Post(
 *     path="/api/login/{numcolaborador}",
 *     summary="Autenticar empleado por número de colaborador",
 *     description="Busca un empleado por número de colaborador y genera un token de acceso.",
 *     tags={"Autenticación"},
 *
 *     @OA\Parameter(
 *         name="numcolaborador",
 *         in="path",
 *         required=true,
 *         description="Número de colaborador",
 *         @OA\Schema(
 *             type="string",
 *             example="12345"
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=200,
 *         description="Autenticación exitosa",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string", example="Autenticación exitosa"),
 *             @OA\Property(property="user", type="object"),
 *             @OA\Property(property="token", type="string", example="1|abc123token")
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=404,
 *         description="Empleado no encontrado",
 *         @OA\JsonContent(
 *             @OA\Property(property="error", type="string", example="Empleado no encontrado.")
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=500,
 *         description="Error interno",
 *         @OA\JsonContent(
 *             @OA\Property(property="error", type="string", example="Error al autenticar empleado")
 *         )
 *     )
 * )
 */
class AuthController {}
