<?php

namespace App\Livewire\Usuarios;

use Illuminate\Foundation\Auth\User;
use Livewire\Component;

class UsuariosIndex extends Component
{
    public $search = '';

    protected $listeners = ['usuarioUpdated' => '$refresh'];

    public function render()
    {
        $usuarios = User::where('nome', 'like', '%'.$this->search.'%')
            ->orWhere('email', 'like', '%'.$this->search.'%')
            ->orderBy('nome', 'asc')
            ->get();

        return view('livewire.usuarios.usuarios-index', ['usuarios' => $usuarios]);
    }

    public function delete($id)
    {
        User::find($id)->delete();
        session()->flash('message', 'Usuário deletado com sucesso!');
    }
}
