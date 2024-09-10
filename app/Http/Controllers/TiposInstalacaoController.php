<?php

namespace App\Http\Controllers;

use App\Models\TipoInstalacao;
use Illuminate\Http\Request;
use OpenAi\Annotations as OA;

class TiposInstalacaoController extends Controller
{
/**
     * @OA\Get(
     *      path="/tipo_instalacao",
     *      summary="Listar todos os Tipos de instalação",
     *      tags={"TiposInstalacao"},
     *      @OA\Response(
     *          response=200,
     *          description="Lista de Tipos de instalação"
     *      )
     * )
     */
    public function index()
    {
        $tipo_instalacao = (new TipoInstalacao)->buscarTodos();

        return view('tipo_instalacao.index', compact('tipo_instalacao'));
    }
}
