<?php

namespace App\Livewire\Dashboard;

use App\Models\Movimentacao;
use App\Models\Notificacao;
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
    public $notificacoes = [];
    public $notificacoesNaoLidas = 0;

    public function mount()
    {
        $this->carregarDados();
        $this->carregarNotificacoes();
        $this->gerarNotificacoesAutomaticas();
    }

    public function carregarDados()
    {
        // Estatísticas básicas
        $this->totalProdutos = Produto::count();
        $this->totalUsuarios = Usuario::count();
        $this->estoqueBaixo = Produto::whereRaw('quantidade <= quantidade_minima')->count();
        $this->movimentacoesHoje = Movimentacao::whereDate('data_movimentacao', today())->count();
        $this->alertas = Produto::whereRaw('quantidade <= quantidade_minima')->get();
    }

    public function carregarNotificacoes()
    {
        // Carrega notificações do banco de dados
        $this->notificacoes = Notificacao::orderBy('lida', 'asc')
            ->orderBy('data_notificacao', 'desc')
            ->limit(10)
            ->get();
        
        $this->notificacoesNaoLidas = Notificacao::where('lida', false)->count();
    }

    public function marcarComoLida($notificacaoId)
    {
        $notificacao = Notificacao::find($notificacaoId);
        if ($notificacao) {
            $notificacao->update(['lida' => true]);
            $this->carregarNotificacoes();
        }
    }

    public function marcarTodasComoLidas()
    {
        Notificacao::where('lida', false)->update(['lida' => true]);
        $this->carregarNotificacoes();
    }

    public function gerarNotificacoesAutomaticas()
    {
        // 1. NOTIFICAÇÕES DE ESTOQUE BAIXO
        $produtosEstoqueBaixo = Produto::whereRaw('quantidade <= quantidade_minima')->get();
        
        foreach ($produtosEstoqueBaixo as $produto) {
            $titulo = "Estoque Baixo ⚠️";
            $mensagem = "{$produto->nome} está com apenas {$produto->quantidade} unidades (mínimo: {$produto->quantidade_minima})";
            
            // Verifica se já existe uma notificação igual não lida
            $notificacaoExistente = Notificacao::where('titulo', $titulo)
                ->where('mensagem', $mensagem)
                ->where('lida', false)
                ->whereDate('created_at', today())
                ->first();
                
            if (!$notificacaoExistente) {
                Notificacao::create([
                    'titulo' => $titulo,
                    'mensagem' => $mensagem,
                    'tipo' => 'warning',
                    'lida' => false,
                    'data_notificacao' => now()
                ]);
            }
        }

        // 2. NOTIFICAÇÕES DE SEM MOVIMENTAÇÕES HOJE (após meio dia)
        if (now()->hour >= 12) {
            $movimentacoesHoje = Movimentacao::whereDate('data_movimentacao', today())->count();
            
            if ($movimentacoesHoje == 0) {
                $notificacaoExistente = Notificacao::where('titulo', 'Sem Movimentações Hoje 📊')
                    ->whereDate('created_at', today())
                    ->first();
                    
                if (!$notificacaoExistente) {
                    Notificacao::create([
                        'titulo' => 'Sem Movimentações Hoje 📊',
                        'mensagem' => 'Nenhuma movimentação de estoque registrada hoje',
                        'tipo' => 'info',
                        'lida' => false,
                        'data_notificacao' => now()
                    ]);
                }
            }
        }

        // 3. NOTIFICAÇÕES DE USUÁRIOS NOVOS (últimas 24h)
        $usuariosNovos = Usuario::where('created_at', '>=', now()->subDay())->count();
        
        if ($usuariosNovos > 0) {
            $notificacaoExistente = Notificacao::where('titulo', 'like', '%Novo Usuário%')
                ->whereDate('created_at', today())
                ->first();
                
            if (!$notificacaoExistente) {
                Notificacao::create([
                    'titulo' => 'Novo Usuário 👥',
                    'mensagem' => "{$usuariosNovos} novo(s) usuário(s) cadastrado(s) nas últimas 24h",
                    'tipo' => 'success',
                    'lida' => false,
                    'data_notificacao' => now()
                ]);
            }
        }

        // 4. NOTIFICAÇÕES DE PRODUTOS SEM ESTOQUE (quantidade zero)
        $produtosSemEstoque = Produto::where('quantidade', 0)->count();
        
        if ($produtosSemEstoque > 0) {
            $notificacaoExistente = Notificacao::where('titulo', 'Produtos Esgotados 🚨')
                ->whereDate('created_at', today())
                ->first();
                
            if (!$notificacaoExistente) {
                Notificacao::create([
                    'titulo' => 'Produtos Esgotados 🚨',
                    'mensagem' => "{$produtosSemEstoque} produto(s) estão com estoque zerado",
                    'tipo' => 'danger',
                    'lida' => false,
                    'data_notificacao' => now()
                ]);
            }
        }

        // 5. NOTIFICAÇÃO DE BOM TRABALHO (quando tudo está ok)
        $totalAlertas = $produtosEstoqueBaixo->count() + $produtosSemEstoque;
        
        if ($totalAlertas == 0 && now()->hour == 9) { // Apenas às 9h da manhã
            $notificacaoExistente = Notificacao::where('titulo', 'Bom Trabalho! 🎉')
                ->whereDate('created_at', today())
                ->first();
                
            if (!$notificacaoExistente) {
                Notificacao::create([
                    'titulo' => 'Bom Trabalho! 🎉',
                    'mensagem' => 'Todos os produtos estão com estoque adequado. Continue assim!',
                    'tipo' => 'success',
                    'lida' => false,
                    'data_notificacao' => now()
                ]);
            }
        }
    }

    public function render()
    {
        return view('livewire.dashboard.dashboard-index');
    }
}
