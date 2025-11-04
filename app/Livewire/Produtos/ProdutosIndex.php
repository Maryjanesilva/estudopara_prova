<?php

namespace App\Livewire\Produtos;

use App\Models\Produto;
use Livewire\Component;

class ProdutosIndex extends Component
{
    public $produtoId;
    public $nome;
    public $descricao;
    public $preco;
    public $quantidade;
    public $quantidade_minima;

    public function mount($produtoId)
    {
        $produto = Produto::findOrFail($produtoId);
        $this->produtoId = $produto->id;
        $this->nome = $produto->nome;
        $this->descricao = $produto->descricao;
        $this->preco = $produto->preco;
        $this->quantidade = $produto->quantidade;
        $this->quantidade_minima = $produto->quantidade_minima;
    }

    public function update()
    {
        $rules = [
            'nome' => 'required|string|max:255',
            'descricao' => 'required|string',
            'preco' => 'required|numeric|min:0',
            'quantidade' => 'required|integer|min:0',
            'quantidade_minima' => 'required|integer|min:0',
        ];

        $this->validate($rules);

        $produto = Produto::find($this->produtoId);
        $produto->update([
            'nome' => $this->nome,
            'descricao' => $this->descricao,
            'preco' => $this->preco,
            'quantidade' => $this->quantidade,
            'quantidade_minima' => $this->quantidade_minima,
        ]);

        session()->flash('message', 'Produto atualizado com sucesso!');
        
        // ✅ CORREÇÃO AQUI: use dispatch() em vez de emit()
        $this->dispatch('produtoUpdated');
    }

    public function render()
    {
        $produtos = Produto::where('nome', 'like', '%'.$this->search.'%')
            ->orderBy('nome', 'asc')
            ->get();

        return view('livewire.produtos.produtos-index', ['produtos' => $produtos]);
    }

    
}
