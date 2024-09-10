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

/**
 * @OA\Delete(
 *      path="/cliente/delete/{id}",
 *      summary="Deletar um cliente",
 *      tags={"Clientes"},
 *      @OA\Parameter(
 *          name="id",
 *          in="path",
 *          required=true,
 *          @OA\Schema(type="integer")
 *      ),
 *      @OA\Response(
 *          response=200,
 *          description="Cliente deletado com sucesso"
 *      ),
 *      @OA\Response(
 *          response=500,
 *          description="Ocorreu um erro ao excluir o cliente"
 *      )
 * )
 */
Route::delete('/cliente/delete/{id}', [ClientesController::class, 'deletar']);

Route::prefix('projeto')->group(function (){

    /**
     * @OA\Post(
     *     path="/projeto/salvar",
     *     summary="Cadastrar um novo projeto",
     *     tags={"Projetos"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"cliente_id", "local_id", "tipo_instalacao_id"},
     *             @OA\Property(property="cliente_id", type="integer", example=1),
     *             @OA\Property(property="local_id", type="integer", example=2),
     *             @OA\Property(property="tipo_instalacao_id", type="integer", example=3),
     *             @OA\Property(property="equipamento", type="object"),
     *         ),
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Projeto cadastrado com sucesso"
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Requisição inválida"
     *     )
     * )
     */
    Route::post('/salvar', [ProjetosController::class, 'salvarProjeto']);

    /**
     * @OA\Delete(
     *      path="/api/projeto/delete/{id}",
     *      summary="Deletar um projeto",
     *      tags={"Projetos"},
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          required=true,
     *          @OA\Schema(type="integer")
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Projeto deletado com sucesso"
     *      ),
     *      @OA\Response(
     *          response=500,
     *          description="Ocorreu um erro ao excluir o projeto"
     *      )
     * )
     */
    Route::delete('/delete/{id}', [ProjetosController::class, 'deletar']);
});
