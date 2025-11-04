<?php

namespace App\Livewire\Usuarios;

use App\Models\Usuario;
use Illuminate\Foundation\Auth\User;
use Livewire\Component;
use Livewire\WithPagination;

class UsuariosIndex extends Component
{
      use WithPagination;
    
    public $search = '';

    protected $listeners = ['usuarioUpdated' => '$refresh'];

    public function updatingSearch()
    {
        $this->resetPage();
    }


    public function render()
    {
        $usuarios = Usuario::where('nome', 'like', '%'.$this->search.'%') 
            ->orWhere('email', 'like', '%'.$this->search.'%')
            ->orderBy('nome', 'asc')
             ->paginate(10); 

        return view('livewire.usuarios.usuarios-index', ['usuarios' => $usuarios]);
    }

      public function delete($id)
    {
        try {
        
            if ($id == auth()->id()) {
                session()->flash('error', 'Você não pode deletar seu próprio usuário!');
                return;
            }

            $usuario = Usuario::findOrFail($id);
            $usuario->delete();
            
            session()->flash('message', 'Usuário deletado com sucesso! ✅');
        } catch (\Exception $e) {
            session()->flash('error', 'Erro ao deletar usuário: ' . $e->getMessage());
        }
    }
}
