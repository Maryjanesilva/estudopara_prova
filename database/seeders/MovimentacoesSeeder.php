<?php

namespace Database\Seeders;

use App\Models\Movimentacao;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MovimentacoesSeeder extends Seeder
{ public function run()
    {
        Movimentacao::create([
            'produto_id' => 1,
            'tipo' => 'entrada',
            'quantidade' => 100,
            'data_movimentacao' => '2023-05-01',
        ]);

        Movimentacao::create([
            'produto_id' => 1,
            'tipo' => 'saida',
            'quantidade' => 50,
            'data_movimentacao' => '2023-05-15',
        ]);

        Movimentacao::create([
            'produto_id' => 2,
            'tipo' => 'entrada',
            'quantidade' => 50,
            'data_movimentacao' => '2023-05-10',
        ]);
    }
}
