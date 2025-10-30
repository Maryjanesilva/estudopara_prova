<?php

namespace App\Livewire\Produtos;

use App\Models\Produto;
use Livewire\Component;

class ProdutosCreate extends Component
{
       public $nome, $descricao, $preco, $quantidade, $quantidade_minima;

    protected $rules = [
        'nome' => 'required|string|max:255',
        'descricao' => 'required|string|max:500',
        'preco' => 'required|numeric|min:0',
        'quantidade' => 'required|integer|min:0',
        'quantidade_minima' => 'required|integer|min:0',
    ];

    public function render()
    {
        return view('livewire.produtos.produtos-create');
    }

    public function store()
    {
        $this->validate();

        Produto::create([
            'nome' => $this->nome,
            'descricao' => $this->descricao,
            'preco' => $this->preco,
            'quantidade' => $this->quantidade,
            'quantidade_minima' => $this->quantidade_minima,
        ]);

        session()->flash('message', 'Produto cadastrado com sucesso!');
        $this->emit('produtoUpdated');
        $this->resetInputFields();
    }

    public function resetInputFields()
    {
        $this->nome = '';
        $this->descricao = '';
        $this->preco = '';
        $this->quantidade = '';
        $this->quantidade_minima = '';
    }
}
