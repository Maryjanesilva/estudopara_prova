<?php

namespace App\Livewire\Estoques;

use App\Models\Movimentacao;
use App\Models\Produto;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class EstoqueCreate extends Component
{
    public $produto_id;
    public $quantidade;
    public $tipo = 'entrada';
    public $data_movimentacao;
    public $observacao;
    public $produtos;

    protected $rules = [
        'produto_id' => 'required|exists:produtos,id',
        'quantidade' => 'required|integer|min:1',
        'tipo' => 'required|in:entrada,saida',
        'data_movimentacao' => 'required|date',
        'observacao' => 'nullable|string|max:255',
    ];

    protected $messages = [
        'produto_id.required' => 'Selecione um produto.',
        'quantidade.required' => 'Informe a quantidade.',
        'quantidade.min' => 'A quantidade deve ser pelo menos 1.',
        'tipo.required' => 'Selecione o tipo de movimentação.',
        'data_movimentacao.required' => 'Informe a data da movimentação.',
    ];

    public function mount()
    {
        $this->produtos = Produto::orderBy('nome')->get();
        $this->data_movimentacao = now()->format('Y-m-d');
    }

    public function salvar()
    {
        $this->validate();

        try {
            DB::transaction(function () {
                // 1. Registrar a movimentação
                $movimentacao = Movimentacao::create([
                    'produto_id' => $this->produto_id,
                    'tipo' => $this->tipo,
                    'quantidade' => $this->quantidade,
                    'data_movimentacao' => $this->data_movimentacao,
                    'observacao' => $this->observacao,
                ]);

                // 2. Atualizar o estoque do produto
                $produto = Produto::find($this->produto_id);
                
                if ($this->tipo === 'entrada') {
                    $produto->increment('quantidade', $this->quantidade);
                } else {
                    // Verificar se há estoque suficiente para saída
                    if ($produto->quantidade < $this->quantidade) {
                        throw new \Exception('Estoque insuficiente! Disponível: ' . $produto->quantidade);
                    }
                    $produto->decrement('quantidade', $this->quantidade);
                }

                // 3. Verificar alerta de estoque baixo
                $this->verificarAlertaEstoque($produto);
            });

            session()->flash('success', 'Movimentação registrada com sucesso! ✅');
            
            // Limpar formulário
            $this->reset(['produto_id', 'quantidade', 'observacao']);
            $this->tipo = 'entrada';
            $this->data_movimentacao = now()->format('Y-m-d');

        } catch (\Exception $e) {
            session()->flash('error', 'Erro: ' . $e->getMessage());
        }
    }

    private function verificarAlertaEstoque(Produto $produto)
    {
        if ($produto->quantidade <= $produto->quantidade_minima) {
            session()->flash('warning', 
                "⚠️ Atenção: {$produto->nome} está com estoque baixo! " .
                "Quantidade atual: {$produto->quantidade} (mínimo: {$produto->quantidade_minima})"
            );
        }
    }

    public function updatedProdutoId($value)
    {
        if ($value) {
            $produto = Produto::find($value);
            if ($produto && $produto->quantidade <= $produto->quantidade_minima) {
                session()->flash('info', 
                    "ℹ️ {$produto->nome} está com estoque baixo! " .
                    "Atual: {$produto->quantidade} (mínimo: {$produto->quantidade_minima})"
                );
            }
        }
    }

    public function updatedQuantidade($value)
    {
        if ($this->tipo === 'saida' && $this->produto_id) {
            $produto = Produto::find($this->produto_id);
            if ($produto && $value > $produto->quantidade) {
                session()->flash('error', 
                    "❌ Estoque insuficiente! Disponível: {$produto->quantidade}"
                );
            }
        }
    }

    public function render()
    {
        return view('livewire.estoques.estoque-create');
    }
}
