<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Projeto extends Model
{
    protected $fillable = ["id", "cliente_id", "local_id", "tipo_instalacao_id"];

    /**
     * Retorna todos os projetos cadastrados
     */
    public function buscarTodos()
    {
        return $this->join('clientes', 'projetos.cliente_id', '=', 'clientes.id')
            ->join('local_projeto', 'projetos.local_id', '=', 'local_projeto.id')
            ->join('tipo_instalacao', 'projetos.tipo_instalacao_id', '=', 'tipo_instalacao.id')
            ->select('projetos.id', 'clientes.nome', 'local_projeto.sigla', 'tipo_instalacao.tipo')
            ->get();
    }

    /**
     * Summary of buscarDetalhes
     * @param int $id_projeto
     * @return void
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
     */
    public function deletarProjeto(int $id_projeto)
    {
        try {
            $this->findOrFail($id_projeto)->delete();
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }
}
