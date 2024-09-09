<?php

namespace App\Http\Controllers;

use App\Models\TipoInstalacao;
use Illuminate\Http\Request;

class TiposInstalacaoController extends Controller
{
    public function index()
    {
        $tipo_instalacao = (new TipoInstalacao)->buscarTodos();

        return view('tipo_instalacao.index', compact('tipo_instalacao'));
    }
}
