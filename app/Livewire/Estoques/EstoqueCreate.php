<?php

namespace App\Livewire\Estoques;

use App\Models\Produto;
use Livewire\Component;

class EstoqueCreate extends Component
{
    public $produto_id;
    public $quantidade;
    public $localizacao;
    public $produtos;

    protected $rules = [
        'produto_id' => 'required|exists:produtos,id',
        'quantidade' => 'required|integer|min:0',
        'localizacao' => 'nullable|string|max:100',
    ];

    public function mount()
    {
        $this->produtos = Produto::all();
    }

    public function salvar()
    {
        $this->validate();

        Estoque::create([
            'produto_id' => $this->produto_id,
            'quantidade' => $this->quantidade,
            'localizacao' => $this->localizacao,
        ]);

        session()->flash('success', 'Estoque cadastrado com sucesso!');
        return redirect()->route('estoques.index');
    }

    public function render()
    {
        return view('livewire.estoques.estoque-create');
    }
}
