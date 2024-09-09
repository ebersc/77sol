<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class EquipamentosProjeto extends Model
{
    use HasFactory;

    protected $table = "equipamentos_projetos";

    protected $fillable = ['id','equipamento_id','projeto_id','quantidade'];

    /**
     * Summary of salvar
     * @param Illuminate\Http\Request $request
     * @param int $id_projeto
     * @return void
     */
    public function salvar(Request $request, int $id_projeto)
    {
        try{
            $this->deletarEquipamentosProjeto($id_projeto);
            foreach($request->input('equipamento') as $key => $equipamento_qtde){
                $quantidade = (int) $equipamento_qtde;
                if($quantidade > 0){
                    $dados = [
                        'equipamento_id' => $key,
                        'projeto_id'     => $id_projeto,
                        'quantidade'     => $quantidade
                    ];

                    (new EquipamentosProjeto)->fill($dados)->save();
                }
            }
        }catch(\Exception $e){
            throw $e;
        }
    }

    public function deletarEquipamentosProjeto(int $id_projeto)
    {
        $this->projeto_id = $id_projeto;
        try{
            $this->where('projeto_id', $id_projeto)->delete();
        }catch(\Exception $e){
            throw $e;
        }
    }
}
