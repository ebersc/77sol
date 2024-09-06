<?php

use App\Http\Controllers\ClientesController;
use App\Http\Controllers\ProjetosController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

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
    Route::get('/cadastrar', [ProjetosController::class, 'cadastrar']);
    Route::get('/detalhes/{id}', [ProjetosController::class, 'verDetalhes']);
    Route::get('/editar/{id}', [ProjetosController::class, 'editar']);
    Route::post('/salvar', [ProjetosController::class, 'salvarProjeto']);
    Route::delete('/delete/{id}', [ProjetosController::class, 'deletar']);
});
