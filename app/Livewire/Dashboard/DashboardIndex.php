<?php

namespace App\Livewire\Dashboard;

use App\Models\Movimentacao;
use App\Models\Produto;
use App\Models\Usuario;
use Livewire\Component;

class DashboardIndex extends Component
{
     public $totalProdutos;
    public $totalUsuarios;
    public $estoqueBaixo;
    public $movimentacoesHoje;
    public $alertas;
    public $atividadeRecente;

    public function mount()
    {
        $this->carregarDados();
    }

    public function carregarDados()
    {
        // Estatísticas básicas
        $this->totalProdutos = Produto::count();
        $this->totalUsuarios = Usuario::count();
        $this->estoqueBaixo = Produto::whereRaw('quantidade <= quantidade_minima')->count();
        $this->movimentacoesHoje = Movimentacao::whereDate('data_movimentacao', today())->count();

        // Produtos com estoque baixo
        $this->alertas = Produto::whereRaw('quantidade <= quantidade_minima')
            ->get(['nome', 'quantidade', 'quantidade_minima']);

        // Atividade recente (últimas movimentações)
        $this->atividadeRecente = Movimentacao::with('produto')
            ->latest()
            ->limit(5)
            ->get();
    }
    public function render()
    {
        return view('livewire.dashboard.dashboard-index');
    }
}
