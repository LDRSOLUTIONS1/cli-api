<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MarcasController;
use App\Http\Controllers\ClientesController;
use App\Http\Controllers\TiposClientesController;
use App\Http\Controllers\GruposController;
use App\Http\Controllers\RegionalesController;
use App\Http\Controllers\ModelosController;
use App\Http\Controllers\ContactosController;
use App\Http\Controllers\DepartamentosController;
use App\Http\Controllers\EstadosController;
use App\Http\Controllers\GraficasController;
use App\Http\Controllers\MunicipiosController;
use App\Http\Controllers\PaisesController;
use App\Http\Controllers\PuestosController;
use App\Http\Controllers\RegimenesFiscalesController;
use App\Http\Controllers\UsuariosController;
use Illuminate\Support\Facades\Route;

Route::post('/login/{numcolaborador}', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::resource('/marcas', MarcasController::class);
    Route::resource('/clientes', ClientesController::class);
    Route::resource('/tipos-clientes', TiposClientesController::class);
    Route::resource('/grupos', GruposController::class);
    Route::resource('/regionales', RegionalesController::class);
    Route::resource('/modelos', ModelosController::class);
    Route::resource('/contactos', ContactosController::class);
    Route::resource('/puestos', PuestosController::class);
    Route::resource('/departamentos', DepartamentosController::class);
    Route::resource('/usuarios', UsuariosController::class);

    Route::get(
        '/regimenes-fiscales/{tipoPersona?}',
        [RegimenesFiscalesController::class, 'getByTipoPersona']
    );
    Route::resource('/paises', PaisesController::class);
    Route::resource('/estados', EstadosController::class);
    Route::resource('/municipios', MunicipiosController::class);

    Route::get('/estados/pais/{pais_id}', [EstadosController::class, 'getByPais']);
    Route::get('/municipios/estado/{estado_id}', [MunicipiosController::class, 'getByEstado']);

    Route::get('/clientes/editar/{id}', [ClientesController::class, 'clientesEditar']);

    Route::post('/users/{id}', [UsuariosController::class, 'asignarTipoCliente']);

    Route::get('/GetClientes', [ClientesController::class, 'GetClientes']);
    Route::get('/user', [AuthController::class, 'user']);

    Route::get('/clientesPorTipo', [GraficasController::class, 'clientesPorTipo']);

    Route::get('/distribuidores', [ClientesController::class, 'distribuidores']);
});
