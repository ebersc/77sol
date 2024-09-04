<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $fillable = ["id", "nome", "email", "telefone","cpf_cnpj"];

    public function buscarTodos()
    {
        return $this->all();
    }

    public function salvar(array $dados)
    {
        try{
            $this->fill($dados);
            $this->save();
        }catch(\Exception $e){
            dd("".$e->getMessage());
        }
    }

    public function deletarCliente(int $id)
    {
        $this->findOrFail($id)->delete();
    }
}
