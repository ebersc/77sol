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
     */
    public function index()
    {
        $projetos = (new Projeto)->buscarTodos();

        return view("projeto.index", compact("projetos"));
    }

    /**
     * Exibe e view para realizar o cadastro de um projeto
     */
    public function cadastrar()
    {
        $dados = $this->montaDadosCombosFormulario();
        return view("projeto.form_projeto", compact("dados"));
    }

    /**
     * Busca e exibe a view para editar os dados do projeto
     * @param int $id - ID do projeto
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
     * Summary of verDetalhes
     * @param int $id
     * @return mixed
     */
    public function verDetalhes(int $id)
    {
        $dados = $this->retornaDetalhesProjeto($id);

        return view("projeto.detalhes_projeto", compact("dados"));
    }

    /**
     * Summary of salvarProjeto
     * @param \Illuminate\Http\Request $request
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
     */
    public function deletar(int $id)
    {
        try {
            (new EquipamentosProjeto)->deletarEquipamentosProjeto($id);
            (new Projeto)->deletarProjeto($id);
            return response()->json(["message" => "Projeto excluido com sucesso!", 200]);
        } catch (\Exception $e) {
            return response()->json(["message" => "Ocorreu um erro ao excluir o projeto", 500]);
        }

    }

    /**
     * Summary of retornaDetalhesProjeto
     * @param int $id_projeto
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

    private function montaDadosCombosFormulario(): array
    {
        return [
            'clientes' => Cliente::all(),
            'equipamento' => Equipamento::all(),
            'locais' => Local::all(),
            'tipo_instalacao' => TipoInstalacao::all()
        ];
    }

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
