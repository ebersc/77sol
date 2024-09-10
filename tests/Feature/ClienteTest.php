<?php

namespace Tests\Feature;

use App\Models\Cliente;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ClienteTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function teste_cadastro_clientes() : void
    {
        $cliente = [
            'nome' => 'Diogo Igor Mário Bernardes',
            'email' => 'diogo_bernardes@astconsult.com.br',
            'telefone' => '66996665215',
            'cpf_cnpj' => '61465026770'
        ];

        $response = $this->post('/cliente/salvar', $cliente);

        $response->assertStatus(201);

        $this->assertDatabaseHas('clientes', [
            'email' => 'diogo_bernardes@astconsult.com.br'
        ]);
    }

    public function teste_cadastro_cliente_sem_nome() : void
    {
        $cliente = [
            'nome' => '',
            'email' => 'diogo_bernardes@astconsult.com.br',
            'telefone' => '66996665215',
            'cpf_cnpj' => '61465026770'
        ];

        $response = $this->post('/cliente/salvar', $cliente);

        $response->assertStatus(302);

        $this->assertDatabaseHas('clientes', [
            'email' => 'diogo_bernardes@astconsult.com.br'
        ]);
    }

    public function teste_atualizacao_cliente() : void
    {
        $cliente = Cliente::factory()->create([
            'nome' => 'Cliente teste da silva',
            'email' => 'cliente.teste@teste.com',
            'telefone' => '11912345678',
            'cpf_cnpj' => '99999998888877'
        ]);

        $dadosAtualizados = [
            'id' => $cliente->id,
            'nome' => 'Cliente atualizado da Silva',
            'email' => 'cliente.atualizado@teste.com',
            'telefone' => '11912345678',
            'cpf_cnpj' => '99999998888877'
        ];

        $response = $this->post('/cliente/salvar', $dadosAtualizados);

        $response->assertStatus(201);

        // Verifica se os dados foram atualizados no banco de dados
        $this->assertDatabaseHas('clientes', [
            'id' => $cliente->id,
            'nome' => 'Cliente atualizado da Silva',
            'email' => 'cliente.atualizado@teste.com',
            'telefone' => '11912345678',
            'cpf_cnpj' => '99999998888877'
        ]);
    }

    public function teste_exclusao_cliente() : void
    {
        $cliente = Cliente::factory()->create();

        $response = $this->deleteJson("/api/cliente/delete/{$cliente->id}");

        $response->assertStatus(200);

        $this->assertDatabaseMissing('clientes', [
            'id' => $cliente->id,
        ]);
    }
}
