<?php

namespace App\Livewire\Usuarios;

use App\Models\Usuario;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class UsuariosEdit extends Component
{
      public $userId, $nome, $email, $senha;

 
    
    public function mount($userId)
    {
        $usuario = Usuario::findOrFail($userId);
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
            'email' => 'required|email|unique:usuarios,email,' . $this->userId,
        ];

        if ($this->senha) {
            $rules['senha'] = 'min:6';
        }

        $this->validate($rules);

        $usuario = Usuario::find($this->userId);
        $usuario->nome = $this->nome;
        $usuario->email = $this->email;
        
        if($this->senha){
            $usuario->senha = Hash::make($this->senha);
        }
        
        $usuario->save();

        session()->flash('message', 'Usuário atualizado com sucesso!');
        $this->dispatch('usuarioUpdated');
       
        $this->senha = '';
    }
}
