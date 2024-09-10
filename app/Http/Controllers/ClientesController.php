<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;

/**
 * @OA\Info(
 *      title="77sol case",
 *      version="0.1"
 * )
 *
 * @OA\PathItem(
 *      path="/cliente"
 * )
 */
class ClientesController extends Controller
{
    /**
     * @OA\Get(
     *      path="/cliente",
     *      summary="Listar todos os clientes cadastrados",
     *      tags={"Clientes"},
     *      @OA\Response(
     *          response=200,
     *          description="Lista de clientes"
     *      )
     * )
     */
    public function index()
    {
        $clientes = (new Cliente)->buscarTodos();

        return view("cliente.index", compact("clientes"));
    }

    /**
     * @OA\Get(
     *      path="/cliente/cadastrar",
     *      summary="Exibir o form de cadastro de clientes",
     *      tags={"Clientes"},
     *      @OA\Response(
     *          response=200,
     *          description="Exibir o form de cadastro de clientes"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Não autorizado"
     *      )
     * )
     */
    public function cadastrar()
    {
        return view("cliente.cadastro");
    }

    /**
     * @OA\Get(
     *      path="/cliente/editar/{id}",
     *      summary="Exibir o form de editar o cliente",
     *      tags={"Clientes"},
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          required=true,
     *          @OA\Schema(type="integer")
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Exibir o form de editar o cliente"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Não autorizado"
     *      )
     * )
     */
    public function editar(int $id)
    {
        $cliente = (new Cliente)->editar($id);
        return view("cliente.cadastro", compact("cliente"));
    }

    /**
     * @OA\Post(
     *     path="/cliente/salvar",
     *     summary="Cadastrar um novo cliente",
     *     tags={"Clientes"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"nome","email", "telefone", "cpf_cnpj"},
     *             @OA\Property(property="nome", type="string", example="Pedro da Silva"),
     *             @OA\Property(property="email", type="string", example="pedro.silva@example.com"),
     *             @OA\Property(property="telefone", type="string", example="11944448888"),
     *             @OA\Property(property="cpf_cnpj", type="string", example="12345678911"),
     *         ),
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Cliente cadastrado com sucesso"
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Requisição inválida"
     *     )
     * )
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
     * @OA\Delete(
     *      path="/api/cliente/delete/{id}",
     *      summary="Deletar um cliente",
     *      tags={"Clientes"},
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          required=true,
     *          @OA\Schema(type="integer")
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Cliente deletado com sucesso"
     *      ),
     *      @OA\Response(
     *          response=500,
     *          description="Ocorreu um erro ao excluir o cliente"
     *      )
     * )
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
