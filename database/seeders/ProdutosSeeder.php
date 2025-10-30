<?php

namespace Database\Seeders;

use App\Models\Produto;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProdutosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
   public function run()
    {
        Produto::create([
            'nome' => 'Camiseta Básica',
            'descricao' => 'Camiseta 100% algodão',
            'preco' => 29.90,
            'quantidade' => 50,
            'quantidade_minima' => 10,
        ]);

        Produto::create([
            'nome' => 'Calça Jeans',
            'descricao' => 'Calça jeans masculina',
            'preco' => 89.90,
            'quantidade' => 30,
            'quantidade_minima' => 5,
        ]);

        Produto::create([
            'nome' => 'Vestido Floral',
            'descricao' => 'Vestido midi com estampa floral',
            'preco' => 129.90,
            'quantidade' => 15,
            'quantidade_minima' => 3,
        ]);
    }
}
