<?php

namespace App\Http\Controllers;

use App\Models\EquipamentosProjeto;
use App\Models\Equipamento;
use App\Models\Projeto;
use App\Models\Cliente;
use App\Models\Local;
use App\Models\TipoInstalacao;
use Illuminate\Http\Request;

class ProjetosController extends Controller
{
    /**
     * Exibe a tela principal com a lista de projetos cadastrados
     * @param \Illuminate\Http\Request $request - Filtros para a listagem
     * @access public
     * @return mixed
     */
    public function index(Request $request)
    {
        $projetos = (new Projeto)->buscarTodos($request);
        $dados = $this->montaDadosCombosFormulario();

        return view("projeto.index", compact("projetos", "dados"));
    }

    /**
     * Exibe e view para realizar o cadastro de um projeto
     * @access public
     * @return mixed
     */
    public function cadastrar()
    {
        $dados = $this->montaDadosCombosFormulario();
        return view("projeto.form_projeto", compact("dados"));
    }

    /**
     * Busca e exibe a view para editar os dados do projeto
     * @param int $id - ID do projeto
     * @access public
     * @return mixed
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
     * Exibir os detalhes do projeto
     * @param int $id - ID do projeto
     * @access public
     * @return mixed
     */
    public function verDetalhes(int $id)
    {
        $dados = $this->retornaDetalhesProjeto($id);

        return view("projeto.detalhes_projeto", compact("dados"));
    }

    /**
     * Salvar o projeto ou atualizar as informações caso seja enviado o ID no request
     * @param \Illuminate\Http\Request $request
     * @access public
     * @return mixed
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
     * Apagar o registro de um projeto
     * @param int $id - ID do projeto
     * @access public
     * @return mixed
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
