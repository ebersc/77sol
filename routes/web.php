<?php

use App\Http\Controllers\ClientesController;
use App\Http\Controllers\ProjetosController;
use App\Http\Controllers\EquipamentosController;
use App\Http\Controllers\TiposInstalacaoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('cliente')->group(function () {
    Route::get('/', [ClientesController::class, 'index']);
    Route::get('/cadastrar', [ClientesController::class,'cadastrar']);
    Route::get('/editar/{id}', [ClientesController::class,'editar']);
    Route::post('/salvar', [ClientesController::class, 'salvar']);
    Route::delete('/delete/{id}', [ClientesController::class, 'deletar']);
});

Route::prefix('projeto')->group(function (){
    Route::get('/', [ProjetosController::class, 'index']);
    Route::post('/', [ProjetosController::class, 'index']);
    Route::get('/cadastrar', [ProjetosController::class, 'cadastrar']);
    Route::get('/detalhes/{id}', [ProjetosController::class, 'verDetalhes']);
    Route::get('/editar/{id}', [ProjetosController::class, 'editar']);
    Route::post('/salvar', [ProjetosController::class, 'salvarProjeto']);
    Route::delete('/delete/{id}', [ProjetosController::class, 'deletar']);
});

Route::prefix('equipamento')->group(function (){
    Route::get('/', [EquipamentosController::class, 'index']);
});

Route::prefix('tipo_instalacao')->group(function(){
    Route::get('/', [TiposInstalacaoController::class, 'index']);
});
