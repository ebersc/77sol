<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipamento extends Model
{
    use HasFactory;

    protected $table = 'equipamento';
    protected $fillable = ['id', 'nome_equipamento'];

    /**
     * Summary of buscarEquipamentoProjeto
     * @param int $id_projeto
     * @return void
     */
    public function buscarEquipamentoProjeto(int $id_projeto)
    {
        return $this->leftJoin('equipamentos_projetos', function ($join) use ($id_projeto){
                        $join->on('equipamento.id', '=', 'equipamentos_projetos.equipamento_id')
                            ->where('equipamentos_projetos.projeto_id', '=', $id_projeto);  // Adiciona a condição de projeto_id
                        })
                    ->select('equipamento.id', 'equipamento.nome_equipamento', 'equipamentos_projetos.quantidade')
                    ->get();
    }

    public function buscarTodos()
    {
        return $this->all();
    }
}
