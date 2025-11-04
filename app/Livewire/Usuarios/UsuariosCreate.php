<?php

namespace App\Livewire\Usuarios;

use App\Models\Usuario;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class UsuariosCreate extends Component
{
    public $nome, $email, $senha;

    protected $rules = [
        'nome' => 'required|string|max:255',
        'email' => 'required|email|unique:usuarios,email', 
        'senha' => 'required|min:6',
    ];
    public function render()
    {
        return view('livewire.usuarios.usuarios-create');
    }

    
    public function store()
    {
        $this->validate();

        Usuario::create([ 
            'nome' => $this->nome,
            'email' => $this->email,
            'senha' => Hash::make($this->senha), 
        ]);

        session()->flash('message', 'Usuário cadastrado com sucesso!');
        $this->dispatch('usuarioUpdated'); 
        $this->resetInputFields();
    }

    public function resetInputFields()
    {
        $this->nome = '';
        $this->email = '';
        $this->senha = '';
    }
}
