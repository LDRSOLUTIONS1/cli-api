<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClientesController;
use App\Http\Controllers\GruposController;
use App\Http\Controllers\TiposClientesController;
use Illuminate\Support\Facades\Route;

Route::post('/login/{numcolaborador}', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', [AuthController::class, 'user']);
    Route::resource('/clientes', ClientesController::class);
    Route::resource('/grupos', GruposController::class);
    Route::resource('/tipos-clientes', TiposClientesController::class);
});
