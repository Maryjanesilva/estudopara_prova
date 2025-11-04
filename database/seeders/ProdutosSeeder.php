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
        Produto::create([
        'nome' => 'Blusa de Moletom',
        'descricao' => 'Blusa de moletom com capuz',
        'preco' => 79.90,
        'quantidade' => 25,
        'quantidade_minima' => 8,
    ]);

    Produto::create([
        'nome' => 'Saia Plissada',
        'descricao' => 'Saia plissada midi em viscose',
        'preco' => 69.90,
        'quantidade' => 20,
        'quantidade_minima' => 4,
    ]);

    Produto::create([
        'nome' => 'Jaqueta de Couro',
        'descricao' => 'Jaqueta de couro legítimo',
        'preco' => 299.90,
        'quantidade' => 10,
        'quantidade_minima' => 2,
    ]);

    Produto::create([
        'nome' => 'Shorts Jeans',
        'descricao' => 'Shorts jeans feminino destroyed',
        'preco' => 59.90,
        'quantidade' => 35,
        'quantidade_minima' => 6,
    ]);

    Produto::create([
        'nome' => 'Blazer Slim',
        'descricao' => 'Blazer masculino slim fit',
        'preco' => 159.90,
        'quantidade' => 18,
        'quantidade_minima' => 3,
    ]);

    Produto::create([
        'nome' => 'Vestido Longo',
        'descricao' => 'Vestido longo para festas',
        'preco' => 189.90,
        'quantidade' => 12,
        'quantidade_minima' => 2,
    ]);

    Produto::create([
        'nome' => 'Polo Básica',
        'descricao' => 'Camisa polo masculina básica',
        'preco' => 49.90,
        'quantidade' => 40,
        'quantidade_minima' => 8,
    ]);

    Produto::create([
        'nome' => 'Macacão Jeans',
        'descricao' => 'Macacão jeans feminino',
        'preco' => 139.90,
        'quantidade' => 15,
        'quantidade_minima' => 3,
    ]);

    Produto::create([
        'nome' => 'Cardigã Tricot',
        'descricao' => 'Cardigã de tricot acolchoado',
        'preco' => 99.90,
        'quantidade' => 22,
        'quantidade_minima' => 5,
    ]);
    }
}
