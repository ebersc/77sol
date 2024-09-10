<?php

namespace Tests\Feature;

use App\Models\Cliente;
use App\Models\Equipamento;
use App\Models\Local;
use App\Models\Projeto;
use App\Models\TipoInstalacao;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProjetoTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    private function gerarDadosProjeto() : array
    {
        $cliente = Cliente::inRandomOrder()->first();
        $local = Local::inRandomOrder()->first();
        $tipo_instalacao = TipoInstalacao::inRandomOrder()->first();

        $equipamentos = Equipamento::inRandomOrder()->limit(3)->get();

        foreach($equipamentos as $key => $value){
            $equipamento[$value->id] = 1;
        }

        return [
            'cliente_id' => $cliente->id,
            'local_id' => $local->id,
            'tipo_instalacao_id' => $tipo_instalacao->id,
            'equipamento' => $equipamento
        ];
    }

    public function teste_cadastro_projeto() : void
    {
        $projeto = $this->gerarDadosProjeto();

        $response = $this->post('/api/projeto/salvar', $projeto);

        $response->assertStatus(201);

        $this->assertDatabaseHas('projetos', [
            'cliente_id' => $projeto['cliente_id'],
            'local_id' => $projeto['local_id'],
            'tipo_instalacao_id' => $projeto['tipo_instalacao_id'],
        ]);
    }

    public function teste_editar_projeto() : void
    {
        $projeto = Projeto::factory()->create();

        $cliente = Cliente::inRandomOrder()->first();

        $equipamentos = Equipamento::inRandomOrder()->limit(3)->get();

        foreach($equipamentos as $key => $value){
            $equipamento[$value->id] = 1;
        }

        $dadosAtualizados = [
            'id' => $projeto->id,
            'cliente_id' => $cliente->id,
            'equipamento' => $equipamento
        ];

        $response = $this->post('/api/projeto/salvar', $dadosAtualizados);

        $response->assertStatus(201);

        $this->assertDatabaseHas('projetos', [
            'id' => $projeto->id,
            'cliente_id' => $cliente->id
        ]);
    }

    public function teste_excluir_projeto() : void
    {
        $projeto = Projeto::factory()->create();

        $response = $this->deleteJson("/api/cliente/delete/{$projeto->id}");

        $response->assertStatus(200);

        $this->assertDatabaseMissing('clientes', [
            'id' => $projeto->id,
        ]);
    }

}
