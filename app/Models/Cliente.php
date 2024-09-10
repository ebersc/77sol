<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Cliente extends Model
{
    use HasFactory;

    protected $fillable = ["id", "nome", "email", "telefone", "cpf_cnpj"];

    /**
     * Retorna todos os clientes cadastrados
     * @access public
     * @return mixed
     */
    public function buscarTodos()
    {
        return $this->all();
    }

    /**
     * Busca as informações de um cliente para realizar a edição do cadastro
     * @param int $id_cliente - ID do cliente
     * @access public
     * @return mixed
     */
    public function editar(int $id_cliente)
    {
        return $this->find($id_cliente);
    }

    /**
     * Cadastra um cliente e caso o cliente já exista atualiza as informações
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Cliente|null $cliente
     * @access public
     * @return void
     */
    public function salvar(Request $request, Cliente $cliente = null)
    {
        try {
            if ($cliente) { // Verifica se existe um cliente para saber se é atualização ou criação
                $cliente->update($request->only(["nome", "email", "telefone", "cpf_cnpj"])); // Atualiza o cliente
            } else {
                $this->fill($request->all()); // Popula o objeto antes de salvar
                $this->save(); // Salva o novo registro
            }
        } catch (\Exception $e) {
            throw $e;
        }
    }

    /**
     * Exclui o registro de um cliente
     * @param int $id_cliente - ID do cliente
     * @access public
     * @return void
     */
    public function deletarCliente(int $id_cliente)
    {
        try {
            $this->findOrFail($id_cliente)->delete();
        } catch (\Exception $e) {
            throw $e;
        }
    }

    /**
     * Relacionamento cliente e projeto 1:N
     * @return mixed
     */
    public function projeto()
    {
        return $this->hasMany(Projeto::class);
    }
}
