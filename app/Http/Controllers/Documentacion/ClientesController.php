<?php

namespace App\Http\Controllers\Documentacion;

/**
 * @OA\Get(
 *     path="/api/GetClientes",
 *     summary="Obtener listado de clientes",
 *     description="Retorna todos los clientes registrados en el sistema.",
 *     tags={"Clientes"},
 *     security={{"sanctum":{}}},
 *
 *     @OA\Response(
 *         response=200,
 *         description="Listado obtenido correctamente"
 *     ),
 *
 *     @OA\Response(
 *         response=401,
 *         description="No autenticado"
 *     ),
 *
 *     @OA\Response(
 *         response=500,
 *         description="Error interno"
 *     )
 * )
 */
class ClientesController {}
