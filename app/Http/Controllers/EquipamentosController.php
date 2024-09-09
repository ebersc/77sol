<?php

namespace App\Http\Controllers;

use App\Models\Equipamento;
use Illuminate\Http\Request;

class EquipamentosController extends Controller
{
    /**
     * Summary of index
     * @return void
     */
    public function index()
    {
        $equipamentos = (new Equipamento)->buscarTodos();

        return view('equipamentos.index', compact('equipamentos'));
    }

}
