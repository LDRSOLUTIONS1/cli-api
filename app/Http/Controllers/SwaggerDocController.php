<?php

namespace App\Http\Controllers;

/**
 * @OA\Info(
 *     version="1.0.0",
 *     title="API Clientes",
 *     description="Documentación de la API para la gestión de clientes",
 *     @OA\Contact(
 *         email="luis.espinoza@ldrsolutions.com.mx"
 *     )
 * )
 *
 * @OA\SecurityScheme(
 *     securityScheme="sanctum",
 *     type="http",
 *     scheme="bearer",
 *     bearerFormat="JWT",
 *     description="Ingresa el token con el formato: Bearer {token}"
 * )
 */
class SwaggerDocController extends Controller {}
