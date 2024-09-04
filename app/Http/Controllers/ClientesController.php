<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClientesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clientes = (new Cliente)->buscarTodos();

        return view("cliente.index", compact("clientes"));
    }

    public function cadastrar()
    {
        return view("cliente.cadastro");
    }

    /**
     * Display the specified resource.
     */
    public function buscar(int $id)
    {
        //
    }

    /**
     * Função para salvar os dados do cliente
     * @param int id
     */
    public function salvar(Request $request) : string
    {
        $dados = [
            'id' => $request->input('id', null),
            'nome' => $request->input('nome'),
            'email' => $request->input('email'),
            'telefone' => $request->input('telefone'),
            'cpf_cnpj' => $request->input('cpf_cnpj'),
        ];

        $validatedData = $request->validate([
            'id' => 'nullable|integer',
            'nome' => 'required|string|max:200',
            'email' => 'required|email|max:250',
            'telefone' => 'required|string|max:11',
            'cpf_cnpj' => 'required|string|max:18',
        ],[
            'nome.required' => 'O nome do cliente não pode estar em branco',
            'email.required' => 'O campo email não pode estar em branco'
        ]);

        (new Cliente)->salvar($dados);

        return response()->json([
            'message' => 'Dados salvos com sucesso!',
            'data' => $validatedData
        ]);
    }

    /**
     * Apagar o registro de um cliente
     */
    public function deletar(int $id)
    {
        (new Cliente)->deletarCliente($id);
    }
}
