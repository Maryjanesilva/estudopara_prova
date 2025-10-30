<?php

namespace App\Livewire\Produtos;

use App\Models\Produto;
use Livewire\Component;

class ProdutosEdit extends Component
{
    public $produtoId, $nome, $descricao, $preco, $quantidade, $quantidade_minima;

    protected $rules = [
        'nome' => 'required|string|max:255',
        'descricao' => 'required|string|max:500',
        'preco' => 'required|numeric|min:0',
        'quantidade' => 'required|integer|min:0',
        'quantidade_minima' => 'required|integer|min:0',
    ];

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

    public function render()
    {
        return view('livewire.produtos.produtos-edit');
    }

    public function update()
    {
        $this->validate();

        $produto = Produto::find($this->produtoId);
        $produto->update([
            'nome' => $this->nome,
            'descricao' => $this->descricao,
            'preco' => $this->preco,
            'quantidade' => $this->quantidade,
            'quantidade_minima' => $this->quantidade_minima,
        ]);

        session()->flash('message', 'Produto atualizado com sucesso!');
        $this->emit('produtoUpdated');
    }
}
