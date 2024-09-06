<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EquipamentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $equipamento = [
            ['nome_equipamento' => 'Módulo'],
            ['nome_equipamento' => 'Inversor'],
            ['nome_equipamento' => 'Microinversor'],
            ['nome_equipamento' => 'Estrutura'],
            ['nome_equipamento' => 'Cabo vermelho'],
            ['nome_equipamento' => 'Cabo preto'],
            ['nome_equipamento' => 'String Box'],
            ['nome_equipamento' => 'Cabo Tronco'],
            ['nome_equipamento' => 'Endcap']
        ];
    }
}
