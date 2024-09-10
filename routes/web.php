<?php

use App\Http\Controllers\ClientesController;
use App\Http\Controllers\ProjetosController;
use App\Http\Controllers\EquipamentosController;
use App\Http\Controllers\TiposInstalacaoController;
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

    /**
     * @OA\Get(
     *      path="/cliente",
     *      summary="Listar todos os clientes cadastrados",
     *      tags={"Clientes"},
     *      @OA\Response(
     *          reponse=200,
     *          description="Lista de clientes"
     *      )
     * )
     */
    Route::get('/', [ClientesController::class, 'index']);

    /**
     * @OA\Get(
     *      path="/cliente/cadastrar",
     *      summary="Exibir o form de cadastro de clientes",
     *      tags={"Clientes"},
     *      @OA\Response(
     *          reponse=200,
     *          description="Exibir o form de cadastro de clientes"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Não autorizado"
     *      )
     * )
     */
    Route::get('/cadastrar', [ClientesController::class,'cadastrar']);

    /**
     * @OA\Get(
     *      path="/cliente/editar/{id}",
     *      summary="Exibir o form de editar o cliente",
     *      tags={"Clientes"},
     *      @OA\Response(
     *          reponse=200,
     *          description="Exibir o form de editar o cliente"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Não autorizado"
     *      )
     * )
     */
    Route::get('/editar/{id}', [ClientesController::class,'editar']);

    /**
     * @OA\Post(
     *     path="/cliente/salvar",
     *     summary="Cadastrar um novo cliente",
     *     tags={"Cliente"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"nome","email", "telefone", "cpf_cnpj"},
     *             @OA\Property(property="nome", type="string", example="Pedro da Silva"),
     *             @OA\Property(property="email", type="string", example="pedro.silva@example.com"),
     *             @OA\Property(property="telefone", type="string", example="11944448888"),
     *             @OA\Property(property="cpf_cnpj", type="string", example="12345678911"),
     *         ),
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Cliente cadastrado com sucesso"
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Requisição inválida"
     *     )
     * )
     */
    Route::post('/salvar', [ClientesController::class, 'salvar']);

    /**
     * @OA\Delete(
     *      path="/cliente/delete{id}",
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
    Route::delete('/delete/{id}', [ClientesController::class, 'deletar']);
});

Route::prefix('projeto')->group(function (){

    /**
     * @OA\Get(
     *      path="/projeto",
     *      summary="Listar todos os projetos cadastrados",
     *      tags={"Projetos"},
     *      @OA\Response(
     *          reponse=200,
     *          description="Lista de projetos"
     *      )
     * )
     */
    Route::get('/', [ProjetosController::class, 'index']);

    /**
     * @OA\Post(
     *     path="/projeto",
     *     summary="Lista os projetos aplicando um filtro de busca",
     *     tags={"Projeto"},
     *     @OA\RequestBody(
     *         required=false,
     *         @OA\JsonContent(
     *             @OA\Property(property="cliente_id", type="int", example="1"),
     *             @OA\Property(property="local_id", type="int", example="2"),
     *             @OA\Property(property="tipo_instalacao_id", type="int", example="3"),
     *         ),
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Lista de projetos"
     *     )
     * )
     */
    Route::post('/', [ProjetosController::class, 'index']);

    /**
     * @OA\Get(
     *      path="/projeto/cadastrar",
     *      summary="Exibir o form de cadastro de projetos",
     *      tags={"Projetos"},
     *      @OA\Response(
     *          reponse=200,
     *          description="Exibir o form de cadastro de projetos"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Não autorizado"
     *      )
     * )
     */
    Route::get('/cadastrar', [ProjetosController::class, 'cadastrar']);

    /**
     * @OA\Get(
     *      path="/projeto/detalhes/{id}",
     *      summary="Exibir os detalhes do projeto",
     *      tags={"Projetos"},
     *      @OA\Response(
     *          reponse=200,
     *          description="Exibir os detalhes do projeto"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Não autorizado"
     *      )
     * )
     */
    Route::get('/detalhes/{id}', [ProjetosController::class, 'verDetalhes']);

    /**
     * @OA\Get(
     *      path="/projeto/editar/{id}",
     *      summary="Exibir o form para editar o projeto",
     *      tags={"Projetos"},
     *      @OA\Response(
     *          reponse=200,
     *          description="Exibir o form para editar o projeto"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Não autorizado"
     *      )
     * )
     */
    Route::get('/editar/{id}', [ProjetosController::class, 'editar']);

    /**
     * @OA\Post(
     *     path="/projeto/salvar",
     *     summary="Cadastrar um novo projeto",
     *     tags={"Projeto"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"cliente_id", "local_id", "tipo_instalacao_id"},
     *             @OA\Property(property="cliente_id", type="int", example="1"),
     *             @OA\Property(property="local_id", type="int", example="2"),
     *             @OA\Property(property="tipo_instalacao_id", type="int", example="3"),
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
     *      path="/projeto/delete{id}",
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

Route::prefix('equipamento')->group(function (){
    /**
     * @OA\Get(
     *      path="/equipamento",
     *      summary="Listar todos os equipamentos",
     *      tags={"Equipamentos"},
     *      @OA\Response(
     *          reponse=200,
     *          description="Lista de equipamentos"
     *      )
     * )
     */
    Route::get('/', [EquipamentosController::class, 'index']);
});

Route::prefix('tipo_instalacao')->group(function(){
    /**
     * @OA\Get(
     *      path="/tipo_instalacao",
     *      summary="Listar todos os Tipos de instalação",
     *      tags={"TiposInstalacao"},
     *      @OA\Response(
     *          reponse=200,
     *          description="Lista de Tipos de instalação"
     *      )
     * )
     */
    Route::get('/', [TiposInstalacaoController::class, 'index']);
});
