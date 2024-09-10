<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Projeto extends Model
{
    use HasFactory;

    protected $fillable = ["id", "cliente_id", "local_id", "tipo_instalacao_id"];

    /**
     * Retorna todos os projetos cadastrados
     * @param \Illuminate\Http\Request $filtro
     * @access public
     * @return mixed
     */
    public function buscarTodos(Request $filtro)
    {
        $filtro = $this->tratarFiltros($filtro);
        return $this->join('clientes', 'projetos.cliente_id', '=', 'clientes.id')
            ->join('local_projeto', 'projetos.local_id', '=', 'local_projeto.id')
            ->join('tipo_instalacao', 'projetos.tipo_instalacao_id', '=', 'tipo_instalacao.id')
            ->select('projetos.id', 'clientes.nome', 'local_projeto.sigla', 'tipo_instalacao.tipo')
            ->where($filtro)
            ->get();
    }

    /**
     * Retorna um array com filtros tratados
     * @param \Illuminate\Http\Request $dados
     * @access private
     * @return array<mixed|string>[]
     */
    private function tratarFiltros(Request $dados)
    {
        $where = [];

        if($dados->cliente_id){
            $where[] = ['clientes.id', '=', $dados->cliente_id];
        }

        if($dados->local_id){
            $where[] = ['local_projeto.id', '=', $dados->local_id];
        }

        if($dados->tipo_instalacao_id){
            $where[] = ['tipo_instalacao.id', '=', $dados->tipo_instalacao_id];
        }

        return $where;
    }

    /**
     * Buscar os detalhes de um projeto
     * @param int $id_projeto - ID do projeto
     * @access public
     * @return mixed
     */
    public function buscarDetalhes(int $id_projeto)
    {
        return $this->where('projetos.id', $id_projeto)
            ->join('clientes', 'projetos.cliente_id', '=', 'clientes.id')
            ->join('local_projeto', 'projetos.local_id', '=', 'local_projeto.id')
            ->join('tipo_instalacao', 'projetos.tipo_instalacao_id', '=', 'tipo_instalacao.id')
            ->select('projetos.id', 'clientes.nome', 'projetos.cliente_id', 'local_projeto.sigla', 'projetos.local_id', 'tipo_instalacao.tipo', 'projetos.tipo_instalacao_id')
            ->first();
    }

    /**
     * Cadastra um projeto e caso o projeto já exista atualiza as informações
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Projeto|null $projeto
     * @access public
     * @return int
     */
    public function salvar(Request $request, Projeto $projeto = null): int
    {
        try {
            if ($projeto) {
                $projeto->update($request->only(["cliente_id", "local_id", "tipo_instalacao_id"]));
            } else {
                $this->fill($request->all());
                $this->save();
            }

            return $projeto->id ?? $this->id;
        } catch (\Exception $e) {
            throw $e;
        }
    }

    /**
     * Exclui o registro de um projeto
     * @param int $id_cliente - ID do projeto
     * @access public
     * @return void
     */
    public function deletarProjeto(int $id_projeto)
    {
        try {
            $this->findOrFail($id_projeto)->delete();
        } catch (\Exception $e) {
            throw $e;
        }
    }

    /**
     * Relacionamento entre projeto e cliente N:1
     * @return mixed
     */
    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }
}
