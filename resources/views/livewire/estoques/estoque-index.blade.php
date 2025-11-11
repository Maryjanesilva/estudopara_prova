<div class="min-h-screen bg-blue-50 p-6 font-sans">
    <div class="max-w-7xl mx-auto">
        <!-- Cabeçalho -->
        <div class="text-center mb-8">
            <h2 class="text-3xl font-bold text-blue-800 mb-2">📦 Controle de Estoque</h2>
            <p class="text-blue-600">Moda Express</p>
        </div>

        {{-- Campo de busca --}}
        <div class="mb-6 text-center">
            <input type="text" wire:model.live="busca"
                   class="px-4 py-2 w-64 rounded-full border-0 shadow-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                   style="background-color: #eef2ff; color: #1e3a8a;"
                   placeholder="🔍 Buscar produto pelo nome...">
        </div>

        {{-- Formulário de edição --}}
        @if($modoEdicao)
            <div class="bg-gradient-to-r from-blue-100 to-cyan-100 p-6 mb-6 rounded-2xl shadow-lg border border-blue-200">
                <h5 class="font-semibold mb-4 text-center text-blue-800">
                    ✏️ Editando estoque de <span class="font-bold">{{ $produtoSelecionado }}</span>
                </h5>
                <div class="flex flex-col md:flex-row justify-center items-center gap-4">
                    <input type="number" wire:model="quantidade" 
                           class="px-4 py-2 w-32 text-center rounded-lg border border-blue-300 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                           placeholder="Quantidade" min="0">
                    <div class="flex gap-2">
                        <button wire:click="atualizar" 
                                class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg transition-colors">
                            💾 Salvar
                        </button>
                        <button wire:click="cancelar" 
                                class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg transition-colors">
                            ❌ Cancelar
                        </button>
                    </div>
                </div>
            </div>
        @endif

        {{-- Mensagem de sucesso --}}
        @if (session()->has('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded shadow">
                {{ session('success') }}
            </div>
        @endif

        {{-- Cards dos produtos --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($produtos as $produto)
                <div class="bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 hover:-translate-y-1 border border-blue-100">
                    <div class="p-6 text-center">
                        <div class="text-4xl mb-3">🛍️</div>
                        <h5 class="text-lg font-bold text-blue-800 mb-2">{{ $produto->nome }}</h5>
                        <p class="text-gray-600 text-sm mb-3">{{ Str::limit($produto->descricao, 60) }}</p>
                        
                        <div class="space-y-2 mb-4">
                            <p class="font-semibold text-gray-700">
                                💰 R$ {{ number_format($produto->preco, 2, ',', '.') }}
                            </p>
                            <p class="font-semibold {{ $produto->quantidade <= $produto->quantidade_minima ? 'text-red-600' : 'text-green-600' }}">
                                📦 {{ $produto->quantidade }} unidades
                            </p>
                            <p class="text-xs text-gray-500">
                                Mínimo: {{ $produto->quantidade_minima }}
                            </p>
                        </div>

                        @if($produto->quantidade <= $produto->quantidade_minima)
                            <div class="bg-yellow-100 border border-yellow-400 text-yellow-800 px-3 py-1 rounded-full text-sm mb-3">
                                ⚠️ Estoque baixo!
                            </div>
                        @endif

                        <button wire:click="editar({{ $produto->id }})"
                                class="border-2 border-blue-500 text-blue-600 hover:bg-blue-500 hover:text-white px-4 py-2 rounded-full transition-all duration-300 font-medium">
                            ✏️ Editar Estoque
                        </button>
                    </div>
                </div>
            @empty
                <div class="col-span-3 text-center py-12">
                    <div class="text-6xl mb-4">😕</div>
                    <p class="text-gray-600 text-lg">
                        @if($busca)
                            Nenhum produto encontrado para "{{ $busca }}"
                        @else
                            Nenhum produto cadastrado
                        @endif
                    </p>
                </div>
            @endforelse
        </div>
    </div>
</div>
