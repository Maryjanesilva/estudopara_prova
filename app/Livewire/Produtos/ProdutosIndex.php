<?php

namespace App\Livewire\Produtos;

use App\Models\Produto;
use Livewire\Component;

class ProdutosIndex extends Component
{
    public $search = '';

    protected $listeners = ['produtoUpdated' => '$refresh'];

    public function render()
    {
        $produtos = Produto::where('nome', 'like', '%'.$this->search.'%')
            ->orderBy('nome', 'asc')
            ->get();

        return view('livewire.produtos.produtos-index', ['produtos' => $produtos]);
    }

    public function delete($id)
    {
        Produto::find($id)->delete();
        session()->flash('message', 'Produto deletado com sucesso!');
    }
}
