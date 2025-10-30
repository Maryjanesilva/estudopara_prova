<div class="container mt-4">
    <h2 class="text-center mb-4 text-purple-700 fw-bold">📦 Controle de Estoque - Moda Express</h2>

    {{-- Campo de busca --}}
    <div class="mb-4 text-center">
        <input type="text" wire:model.live="busca"
               class="form-control w-50 mx-auto rounded-pill shadow-sm border-0"
               style="background-color: #f3e8ff; color: #581c87;"
               placeholder="🔍 Buscar produto pelo nome...">
    </div>

    {{-- Formulário de edição --}}
    @if($modoEdicao)
        <div class="card p-4 mb-4 shadow-lg border-0 rounded-4 bg-gradient"
             style="background: linear-gradient(135deg, #e0b3ff, #c9a0ff); color: #4b0082;">
            <h5 class="fw-semibold mb-3 text-center">✏️ Editar Estoque de <span class="text-dark">{{ $produtoSelecionado }}</span></h5>
            <div class="d-flex flex-column flex-md-row justify-content-center align-items-center gap-3">
                <input type="number" wire:model="quantidade" class="form-control w-25 text-center"
                       placeholder="Quantidade">
                <div>
                    <button wire:click="atualizar" class="btn btn-success me-2">💾 Salvar</button>
                    <button wire:click="cancelar" class="btn btn-secondary">❌ Cancelar</button>
                </div>
            </div>
        </div>
    @endif

    {{-- Mensagem de sucesso --}}
    @if (session()->has('success'))
        <div class="alert alert-success text-center shadow-sm rounded-pill">
            {{ session('success') }}
        </div>
    @endif

    {{-- Cards fofinhos dos produtos --}}
    <div class="row g-4 justify-content-center">
        @forelse($produtos as $produto)
            <div class="col-md-4 col-sm-6">
                <div class="card border-0 shadow-lg rounded-4 h-100 hover-card"
                     style="background: linear-gradient(135deg, #f2e1ff, #e6ccff);">
                    <div class="card-body text-center">
                        <div class="fs-1 mb-2">🛍️</div>
                        <h5 class="card-title text-purple-800 fw-bold">{{ $produto->nome }}</h5>
                        <p class="text-muted small">{{ $produto->descricao }}</p>
                        <p class="mb-1 fw-semibold text-dark">💰 R$ {{ number_format($produto->preco, 2, ',', '.') }}</p>
                        <p class="fw-semibold {{ $produto->quantidade <= $produto->quantidade_minima ? 'text-danger' : 'text-success' }}">
                            📦 {{ $produto->quantidade }} unidades
                        </p>

                        @if($produto->quantidade <= $produto->quantidade_minima)
                            <div class="alert alert-warning p-1 small rounded-3">⚠️ Estoque baixo!</div>
                        @endif

                        <button wire:click="editar({{ $produto->id }})"
                                class="btn btn-outline-purple mt-2 px-4 py-1 rounded-pill">
                            ✏️ Editar Estoque
                        </button>
                    </div>
                </div>
            </div>
        @empty
            <div class="text-center text-muted mt-4">
                <p>❌ Nenhum produto encontrado com o nome "<strong>{{ $busca }}</strong>"</p>
            </div>
        @endforelse
    </div>
</div>

<style>
.text-purple-700 { color: #6b21a8; }
.text-purple-800 { color: #581c87; }

.btn-outline-purple {
    border: 2px solid #b57aff;
    color: #581c87;
    transition: all 0.3s;
}
.btn-outline-purple:hover {
    background-color: #b57aff;
    color: white;
}
.hover-card {
    transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
}
.hover-card:hover {
    transform: translateY(-6px);
    box-shadow: 0px 6px 25px rgba(182, 132, 255, 0.4);
}
.bg-gradient {
    background: linear-gradient(135deg, #e9d5ff, #d8b4fe);
}
</style>
