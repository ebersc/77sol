<?php

namespace App\Http\Controllers;

use App\Models\Equipamento;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;

class EquipamentosController extends Controller
{
    /**
     * @OA\Get(
     *      path="/equipamento",
     *      summary="Listar todos os equipamentos",
     *      tags={"Equipamentos"},
     *      @OA\Response(
     *          response=200,
     *          description="Lista de equipamentos"
     *      )
     * )
     */
    public function index()
    {
        $equipamentos = (new Equipamento)->buscarTodos();

        return view('equipamentos.index', compact('equipamentos'));
    }

}
