<?php

namespace Database\Factories;

use App\Models\Cliente;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cliente>
 */
class ClienteFactory extends Factory
{
    protected $model = Cliente::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "nome" => $this->faker->name,
            "email" => $this->faker->unique()->email,
            "telefone" => $this->faker->phoneNumber,
            "cpf_cnpj" => $this->geraNumerosAleatoriosDoc()
        ];
    }

    private function geraNumerosAleatoriosDoc() :string
    {
        $numerosAleatorios = [];

        for ($i = 0; $i < 11; $i++) {
            $numerosAleatorios[] = rand(0, 9);
        }

        return implode('', $numerosAleatorios);
    }
}
