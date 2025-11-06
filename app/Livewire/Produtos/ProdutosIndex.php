<?php

namespace App\Livewire\Produtos;

use App\Models\Produto;
use Livewire\Component;

class ProdutosIndex extends Component
{
    public $search = ''; // ✅ ADICIONAR esta propriedade

    protected $listeners = ['produtoUpdated' => '$refresh'];

    
   

    public function render()
    {
         $produtos = Produto::where('nome', 'like', '%'.$this->search.'%')
            ->orWhere('descricao', 'like', '%'.$this->search.'%') // ✅ ADICIONAR busca por descrição
            ->orderBy('nome', 'asc')
            ->get();
        return view('livewire.produtos.produtos-index', ['produtos' => $produtos]);
    }
    public function delete($id)
    {
        try {
            $produto = Produto::findOrFail($id);
            $produto->delete();
            
            session()->flash('message', 'Produto deletado com sucesso!');
            $this->dispatch('produtoUpdated'); // ✅ Já está correto com dispatch()
        } catch (\Exception $e) {
            session()->flash('error', 'Erro ao deletar produto: ' . $e->getMessage());
        }
    }

    
}
