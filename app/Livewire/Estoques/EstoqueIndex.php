<?php

namespace App\Livewire\Estoques;

use App\Models\Produto;
use Livewire\Component;

class EstoqueIndex extends Component
{
    public $estoques;
    public $produtos;

    public function mount()
    {
        $this->estoques = EstoqueIndex::with('produto')->get();
        $this->produtos = Produto::all();
    }

    
    public function render()
    {
        return view('livewire.estoques.estoque-index');
    }
}
