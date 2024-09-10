<?php

use App\Http\Controllers\ClientesController;
use App\Http\Controllers\ProjetosController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::delete('/cliente/delete/{id}', [ClientesController::class, 'deletar']);

Route::prefix('projeto')->group(function (){
    Route::post('/salvar', [ProjetosController::class, 'salvarProjeto']);
    Route::delete('/delete/{id}', [ProjetosController::class, 'deletar']);
});
