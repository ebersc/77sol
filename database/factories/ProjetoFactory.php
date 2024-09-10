<?php

namespace Database\Factories;

use App\Models\Cliente;
use App\Models\Equipamento;
use App\Models\Projeto;
use App\Models\Local;
use App\Models\TipoInstalacao;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Projeto>
 */
class ProjetoFactory extends Factory
{
    protected $model = Projeto::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $dados = $this->gerarDados();

        $equipamentos = Equipamento::inRandomOrder()->limit(3)->get();

        foreach($equipamentos as $key => $value){
            $equipamento[$value->id] = 1;
        }

        return [
            "cliente_id" => $dados['cliente_id'],
            "local_id" => $dados['local_id'],
            "tipo_instalacao_id" => $dados['tipo_instalacao']
        ];
    }

    private function gerarDados() : array
    {
        $cliente = Cliente::inRandomOrder()->first();
        $local = Local::inRandomOrder()->first();
        $tipo_instalacao = TipoInstalacao::inRandomOrder()->first();

        return [
            'cliente_id' => $cliente->id,
            'local_id' => $local->id,
            'tipo_instalacao' => $tipo_instalacao->id
        ];
    }
}
