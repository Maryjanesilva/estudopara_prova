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
    }
}
