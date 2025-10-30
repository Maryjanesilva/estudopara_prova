<?php

namespace App\Livewire\Usuarios;

use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class UsuariosEdit extends Component
{
     public $userId, $nome, $email, $senha;

    protected $rules = [
        'nome' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
    ];

    public function mount($userId)
    {
        $usuario = User::findOrFail($userId);
        $this->userId = $usuario->id;
        $this->nome = $usuario->nome;
        $this->email = $usuario->email;
        $this->senha = '';
    }

    public function render()
    {
        return view('livewire.usuarios.usuarios-edit');
    }

    public function update()
    {
        $rules = [
            'nome' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $this->userId,
        ];

        $this->validate($rules);

        $usuario = User::find($this->userId);
        $usuario->nome = $this->nome;
        $usuario->email = $this->email;
        if($this->senha){
            $usuario->password = Hash::make($this->senha);
        }
        $usuario->save();

        session()->flash('message', 'Usuário atualizado com sucesso!');
        $this->emit('usuarioUpdated'); // Atualiza a lista
    }
}
