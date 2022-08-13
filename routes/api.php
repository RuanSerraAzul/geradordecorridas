<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CorridaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DriverController;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
//Sessão das corridas
Route::get('/Corridas', [CorridaController::class, 'index']);
Route::post('/Corridas/Corridas', [CorridaController::class, 'addCorridasData']); //para armazenar as corridas no DB
Route::get('/Corridas/Corridas', [CorridaController::class, 'useCorridasData']); //exibir corridas registradas
Route::post('/Corridas/PagarCorridas', [CorridaController::class, 'addCorridasPayment']); //para registrar o pagamento de corridas
Route::post('/Corridas/CancelarCorridas', [CorridaController::class, 'cancelCorridas']); //cancelar as corridas em andamento
Route::post('/Corridas/EncerrarCorridas', [CorridaController::class, 'endCorridas']); //encerrar corrida para habilitar o pagamento

//Sessão dos usuarios
Route::get('/Corridas/Usuarios', [UserController::class, 'useUserData']); //listar usuarios
Route::delete('/Corridas/Usuarios', [UserController::class, 'deleteUserData']); //editar dados de usuario
Route::post('/Corridas/Usuarios', [UserController::class, 'addUserData']); //adicionar usuario

//Sessão dos motoristas
Route::get('/Corridas/Motoristas', [DriverController::class, 'useDriverData']); //listar usuarios
Route::delete('/Corridas/Motoristas', [DriverController::class, 'deleteDriverData']); //editar dados de usuario
Route::post('/Corridas/Motoristas', [DriverController::class, 'addDriverData']); //adicionar usuario

