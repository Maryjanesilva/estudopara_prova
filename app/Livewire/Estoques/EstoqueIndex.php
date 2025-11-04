<?php

namespace App\Livewire\Estoques;

use App\Models\Movimentacao;
use App\Models\Produto;
use Livewire\Component;

class EstoqueIndex extends Component
{
    public $produtos; 
    public $busca = ''; 
    public $modoEdicao = false; 
    public $produtoSelecionado; 
    public $quantidade; 
    public $produtoId; 

    public function mount()
    {
        $this->carregarProdutos();
    }

    public function carregarProdutos()
    {
        if (!empty($this->busca)) {
            $this->produtos = Produto::where('nome', 'like', '%' . $this->busca . '%')->get();
        } else {
            $this->produtos = Produto::all();
        }
    }

    public function updatedBusca()
    {
        $this->carregarProdutos();
    }

    public function editar($produtoId)
    {
        $produto = Produto::find($produtoId);
        $this->produtoSelecionado = $produto->nome;
        $this->quantidade = $produto->quantidade;
        $this->produtoId = $produtoId;
        $this->modoEdicao = true;
    }

    public function atualizar()
    {
        $this->validate([
            'quantidade' => 'required|numeric|min:0'
        ]);

        $produto = Produto::find($this->produtoId);
        $produto->update([
            'quantidade' => $this->quantidade
        ]);

        // Opcional: Registrar movimentação
        Movimentacao::create([
            'produto_id' => $this->produtoId,
            'tipo' => 'entrada',
            'quantidade' => $this->quantidade - $produto->getOriginal('quantidade'),
            'data_movimentacao' => now(),
        ]);

        $this->modoEdicao = false;
        $this->carregarProdutos();
        session()->flash('success', 'Estoque atualizado com sucesso!');
    }

    public function cancelar()
    {
        $this->modoEdicao = false;
        $this->produtoSelecionado = null;
        $this->quantidade = null;
        $this->produtoId = null;
    }

    
    public function render()
    {
        return view('livewire.estoques.estoque-index');
    }
}
