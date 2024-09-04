<?php

use App\Http\Controllers\ClientesController;
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
    Route::post('/salvar', [ClientesController::class, 'salvar']);
    Route::get('/delete/{id}', [ClientesController::class, 'deletar']);
});
