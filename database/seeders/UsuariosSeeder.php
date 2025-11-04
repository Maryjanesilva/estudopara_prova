<?php

namespace Database\Seeders;

use App\Models\Usuario;
use Illuminate\Container\Attributes\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsuariosSeeder extends Seeder
{
  public function run()
    {
        Usuario::create([
            'nome' => 'Administrador',
            'email' => 'admin@modaexpress.com',
            'senha' => Hash::make('123456'),
        ]);

        Usuario::create([
            'nome' => 'João Silva',
            'email' => 'joao@modaexpress.com',
            'senha' => Hash::make('123456'),
        ]);

        Usuario::create([
            'nome' => 'Maria Santos',
            'email' => 'maria@modaexpress.com',
            'senha' => Hash::make('123456'),
        ]);

         Usuario::create([
        'nome' => 'Ana Carolina Lima',
        'email' => 'ana.lima@modaexpress.com',
        'senha' => Hash::make('123456'),
    ]);

    Usuario::create([
        'nome' => 'Pedro Henrique Oliveira',
        'email' => 'pedro.oliveira@modaexpress.com',
        'senha' => Hash::make('123456'),
    ]);

    Usuario::create([
        'nome' => 'Carla Regina Souza',
        'email' => 'carla.souza@modaexpress.com',
        'senha' => Hash::make('123456'),
    ]);

    Usuario::create([
        'nome' => 'Ricardo Almeida',
        'email' => 'ricardo.almeida@modaexpress.com',
        'senha' => Hash::make('123456'),
    ]);

    Usuario::create([
        'nome' => 'Fernanda Costa',
        'email' => 'fernanda.costa@modaexpress.com',
        'senha' => Hash::make('123456'),
    ]);

    Usuario::create([
        'nome' => 'Bruno Rodrigues',
        'email' => 'bruno.rodrigues@modaexpress.com',
        'senha' => Hash::make('123456'),
    ]);

    Usuario::create([
        'nome' => 'Juliana Pereira',
        'email' => 'juliana.pereira@modaexpress.com',
        'senha' => Hash::make('123456'),
    ]);
    }
}
