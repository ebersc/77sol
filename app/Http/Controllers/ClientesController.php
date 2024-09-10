<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClientesController extends Controller
{
    /**
     * Exibe a tela principal com a lista de clientes cadastrados
     * @access public
     * @return mixed
     */
    public function index()
    {
        $clientes = (new Cliente)->buscarTodos();

        return view("cliente.index", compact("clientes"));
    }

    /**
     * Exibe e view para realizar o cadastro de clientes
     * @access public
     * @return mixed
     */
    public function cadastrar()
    {
        return view("cliente.cadastro");
    }

    /**
     * Busca e exibe a view para editar os dados do cliente
     * @param int $id - ID do cliente
     * @access public
     * @return mixed
     */
    public function editar(int $id)
    {
        $cliente = (new Cliente)->editar($id);
        return view("cliente.cadastro", compact("cliente"));
    }

    /**
     * Função para salvar os dados do cliente
     * @param \Illuminate\Http\Request $request - Dados do formulário
     * @access public
     * @return mixed
     */
    public function salvar(Request $request)
    {
        $validatedData = $request->validate([
            'id' => 'nullable|integer',
            'nome' => 'required|string|max:200',
            'email' => 'required|email|max:250',
            'telefone' => 'required|string|max:11',
            'cpf_cnpj' => 'required|string|max:18',
        ]);

        $cliente = Cliente::find($request->input('id'));

        $cliente = (new Cliente)->salvar($request, $cliente);

        return response()->json([
            'success' => true,
            'message' => 'Cliente cadastrado com sucesso!',
            'cliente' => $cliente,
        ], 201);
    }

    /**
     * Apagar o registro de um cliente
     * @param int $id - ID do cliente
     * @access public
     * @return mixed
     */
    public function deletar(int $id)
    {
        try {
            (new Cliente)->deletarCliente($id);
            return response()->json(["message" => "Cliente excluido com sucesso!"], 200);
        } catch (\Exception $e) {
            return response()->json(["message" => "Ocorreu um erro ao excluir o cliente"], 500);
        }

    }
}
