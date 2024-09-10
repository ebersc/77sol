<?php

namespace App\Http\Controllers;

use App\Models\EquipamentosProjeto;
use App\Models\Equipamento;
use App\Models\Projeto;
use App\Models\Cliente;
use App\Models\Local;
use App\Models\TipoInstalacao;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;

/**
 *
 * @OA\PathItem(
 *      path="/projeto"
 * )
 */
class ProjetosController extends Controller
{
    /**
     * @OA\Get(
     *      path="/projeto",
     *      summary="Listar todos os projetos cadastrados",
     *      tags={"Projetos"},
     *      @OA\Response(
     *          response=200,
     *          description="Lista de projetos"
     *      )
     * )
     */
    /**
     * @OA\Post(
     *     path="/projeto",
     *     summary="Lista os projetos aplicando um filtro de busca",
     *     tags={"Projetos"},
     *     @OA\RequestBody(
     *         required=false,
     *         @OA\JsonContent(
     *             @OA\Property(property="cliente_id", type="integer", example=1),
     *             @OA\Property(property="local_id", type="integer", example=2),
     *             @OA\Property(property="tipo_instalacao_id", type="integer", example=3),
     *         ),
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Lista de projetos"
     *     )
     * )
     */
    public function index(Request $request)
    {
        $projetos = (new Projeto)->buscarTodos($request);
        $dados = $this->montaDadosCombosFormulario();

        return view("projeto.index", compact("projetos", "dados"));
    }

    /**
     * @OA\Get(
     *      path="/projeto/cadastrar",
     *      summary="Exibir o form de cadastro de projetos",
     *      tags={"Projetos"},
     *      @OA\Response(
     *          response=200,
     *          description="Exibir o form de cadastro de projetos"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Não autorizado"
     *      )
     * )
     */
    public function cadastrar()
    {
        $dados = $this->montaDadosCombosFormulario();
        return view("projeto.form_projeto", compact("dados"));
    }

    /**
     * @OA\Get(
     *      path="/projeto/editar/{id}",
     *      summary="Exibir o form para editar o projeto",
     *      tags={"Projetos"},
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          required=true,
     *          @OA\Schema(type="integer")
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Exibir o form para editar o projeto"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Não autorizado"
     *      )
     * )
     */
    public function editar(int $id)
    {
        $projeto = $this->retornaDetalhesProjeto($id);

        $dados = $this->montaDadosCombosFormulario();

        if ($projeto) {
            $dados['equipamento'] = $projeto['equipamento'];
        }

        $dados = array_merge($dados, $projeto);

        return view("projeto.form_projeto", compact("dados"));
    }

    /**
     * @OA\Get(
     *      path="/projeto/detalhes/{id}",
     *      summary="Exibir os detalhes do projeto",
     *      tags={"Projetos"},
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          required=true,
     *          @OA\Schema(type="integer")
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Exibir os detalhes do projeto"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Não autorizado"
     *      )
     * )
     */
    public function verDetalhes(int $id)
    {
        $dados = $this->retornaDetalhesProjeto($id);

        return view("projeto.detalhes_projeto", compact("dados"));
    }

    /**
     * @OA\Post(
     *     path="/api/projeto/salvar",
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
    public function salvarProjeto(Request $request)
    {
        $projeto = Projeto::find($request->input('id'));

        $id_projeto = (new Projeto)->salvar($request, $projeto);
        (new EquipamentosProjeto)->salvar($request, $id_projeto);

        return response()->json([
            'message' => 'Dados salvos com sucesso!',
        ], 201);
    }

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
    public function deletar(int $id)
    {
        try {
            (new EquipamentosProjeto)->deletarEquipamentosProjeto($id);
            (new Projeto)->deletarProjeto($id);
            return response()->json(["message" => "Projeto excluido com sucesso!"], 200);
        } catch (\Exception $e) {
            return response()->json(["message" => "Ocorreu um erro ao excluir o projeto"], 500);
        }

    }

    /**
     * Retorna um array com os dados do projeto e os equipamentos a serem utilizados
     * @param int $id_projeto - ID do projeto
     * @access private
     * @return array
     */
    private function retornaDetalhesProjeto(int $id_projeto): array
    {
        $projeto = (new Projeto)->buscarDetalhes($id_projeto);

        $equipamento = (new Equipamento)->buscarEquipamentoProjeto($id_projeto);

        return [
            'projeto' => $projeto,
            'equipamento' => $equipamento
        ];
    }

    /**
     * Retorna um array com dados para a montagem dos selects
     * @access private
     * @return array
     */
    private function montaDadosCombosFormulario(): array
    {
        return [
            'clientes' => Cliente::all(),
            'equipamento' => Equipamento::all(),
            'locais' => Local::all(),
            'tipo_instalacao' => TipoInstalacao::all()
        ];
    }

    /**
     * Retorna um array com a lista de todos os equipamentos disponiveis
     * @access private
     * @return array
     */
    private function getEquipamentos(): array
    {
        $dados = (new Equipamento)->all()->toArray();

        foreach ($dados as $key => $value) {
            $id = $value['id'];
            $equipamento['equipamento'][$id] = $value['nome_equipamento'];
        }

        return $equipamento;
    }
}
