<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoInstalacao extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tipoInstalacao = [
            ['tipo' => 'Fibrocimento (Madeira)'],
            ['tipo' => 'Fibrocimento (Metálico)'],
            ['tipo' => 'Cerâmico'],
            ['tipo' => 'Metálico'],
            ['tipo' => 'Laje'],
            ['tipo' => 'Solo'],
        ];

        DB::table('tipo_instalacao')->insert($tipoInstalacao);
    }
}
