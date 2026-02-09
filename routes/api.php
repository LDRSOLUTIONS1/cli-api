<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClientesController;
use Illuminate\Support\Facades\Route;

Route::post('/login/{numcolaborador}', [AuthController::class, 'login']);
Route::resource('/clientes', ClientesController::class);

Route::middleware('auth:sanctum')->group(function () {

    Route::get('/user', [AuthController::class, 'user']);
});
