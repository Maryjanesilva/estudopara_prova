<div class="min-h-screen bg-gradient-to-br from-purple-50 to-pink-50 p-6 font-sans">
    <div class="max-w-7xl mx-auto">
        
        <!-- Cabeçalho -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-white rounded-full shadow-lg mb-4 border border-purple-200">
                <span class="text-3xl">🛍️</span>
            </div>
            <h2 class="text-4xl font-bold bg-gradient-to-r from-purple-600 to-pink-600 bg-clip-text text-transparent mb-3">
                Gerenciar Produtos
            </h2>
            <p class="text-purple-500 text-lg">Gerencie os produtos do sistema</p>
        </div>

        <!-- Mensagens -->
        @if (session()->has('message'))
            <div class="mb-6 bg-gradient-to-r from-green-100 to-emerald-100 border-l-4 border-green-500 text-green-800 p-4 rounded-2xl shadow-lg">
                <div class="flex items-center gap-3">
                    <span class="text-2xl">✅</span>
                    <span class="font-medium">{{ session('message') }}</span>
                </div>
            </div>
        @endif

        @if (session()->has('error'))
            <div class="mb-6 bg-gradient-to-r from-red-100 to-pink-100 border-l-4 border-red-500 text-red-800 p-4 rounded-2xl shadow-lg">
                <div class="flex items-center gap-3">
                    <span class="text-2xl">❌</span>
                    <span class="font-medium">{{ session('error') }}</span>
                </div>
            </div>
        @endif

        <!-- Barra de Ações -->
        <div class="bg-white rounded-2xl shadow-lg p-6 mb-6 border border-purple-100">
            <div class="flex flex-col lg:flex-row justify-between items-center gap-4">
                <!-- Busca -->
                <div class="relative flex-1 w-full">
                    <input type="text" wire:model.live="search" 
                           class="w-full pl-12 pr-4 py-3 rounded-2xl border-2 border-purple-200 focus:border-purple-500 focus:ring-2 focus:ring-purple-200 transition-all bg-white text-purple-800"
                           placeholder="🔍 Buscar por nome ou descrição...">
                    <div class="absolute left-4 top-1/2 transform -translate-y-1/2 text-purple-400">
                        
                    </div>
                </div>
                
                <!-- Botão Novo Produto -->
                <a href="{{ route('produtos.create') }}" 
                   class="bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 text-white py-3 px-6 rounded-2xl font-bold transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl flex items-center gap-3 whitespace-nowrap">
                    <span>➕</span>
                    <span>Novo Produto</span>
                </a>
            </div>
        </div>

        <!-- Tabela de Produtos -->
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden border border-purple-100">
            <!-- Cabeçalho da Tabela -->
            <div class="bg-gradient-to-r from-purple-600 to-pink-600 px-6 py-4">
                <div class="grid grid-cols-12 gap-4 text-white font-bold">
                    <div class="col-span-4">🛍️ Produto</div>
                    <div class="col-span-5">📝 Descrição</div>
                    <div class="col-span-3 text-center">⚙️ Ações</div>
                </div>
            </div>

            <!-- Corpo da Tabela -->
            <div class="divide-y divide-purple-100">
                @forelse($produtos as $produto)
                    <div class="grid grid-cols-12 gap-4 px-6 py-4 hover:bg-purple-50 transition-colors group">
                        <!-- Nome e Preço -->
                        <div class="col-span-4 flex items-center gap-3">
                            <div class="w-10 h-10 bg-gradient-to-r from-purple-400 to-pink-400 rounded-full flex items-center justify-center text-white font-bold">
                                🛍️
                            </div>
                            <div>
                                <p class="font-semibold text-purple-800">{{ $produto->nome }}</p>
                                <p class="text-green-600 font-bold">R$ {{ number_format($produto->preco, 2, ',', '.') }}</p>
                            </div>
                        </div>

                        <!-- Descrição e Estoque -->
                        <div class="col-span-5 flex items-center">
                            <div>
                                <p class="text-purple-600">{{ Str::limit($produto->descricao, 60) }}</p>
                                <div class="flex gap-4 mt-1">
                                    <span class="text-purple-500 text-sm">Estoque: {{ $produto->quantidade }}</span>
                                    <span class="text-gray-500 text-sm">Mín: {{ $produto->quantidade_minima }}</span>
                                    @if($produto->quantidade <= $produto->quantidade_minima)
                                        <span class="text-red-500 text-sm font-bold">⚠️ Baixo</span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Ações -->
                        <div class="col-span-3 flex items-center justify-center gap-2">
                            <!-- Editar -->
                            <a href="{{ route('produtos.edit', $produto->id) }}"
                               class="bg-gradient-to-r from-yellow-400 to-orange-400 hover:from-yellow-500 hover:to-orange-500 text-white p-2 rounded-xl transition-all duration-300 transform hover:scale-110 shadow hover:shadow-md group/tooltip relative"
                               title="Editar Produto">
                                <span class="text-sm">✏️</span>
                                <div class="absolute bottom-full mb-2 hidden group-hover/tooltip:block bg-gray-800 text-white text-xs py-1 px-2 rounded">
                                    Editar
                                </div>
                            </a>

                            <!-- Deletar -->
                            <button wire:click="delete({{ $produto->id }})" 
                                    onclick="return confirm('Tem certeza que deseja excluir este produto?')"
                                    class="bg-gradient-to-r from-red-500 to-pink-500 hover:from-red-600 hover:to-pink-600 text-white p-2 rounded-xl transition-all duration-300 transform hover:scale-110 shadow hover:shadow-md group/tooltip relative"
                                    title="Excluir Produto">
                                <span class="text-sm">🗑️</span>
                                <div class="absolute bottom-full mb-2 hidden group-hover/tooltip:block bg-gray-800 text-white text-xs py-1 px-2 rounded">
                                    Excluir
                                </div>
                            </button>
                        </div>
                    </div>
                @empty
                    <!-- Estado Vazio -->
                    <div class="text-center py-12">
                        <div class="text-6xl mb-4">😕</div>
                        <p class="text-gray-600 text-lg mb-2">
                            @if($search)
                                Nenhum produto encontrado para "{{ $search }}"
                            @else
                                Nenhum produto cadastrado
                            @endif
                        </p>
                        <p class="text-purple-400 text-sm">Clique em "Novo Produto" para adicionar o primeiro</p>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Paginação (se estiver usando) -->
        @if(method_exists($produtos, 'links'))
            <div class="mt-6 bg-white rounded-2xl shadow-lg p-4 border border-purple-100">
                {{ $produtos->links() }}
            </div>
        @endif

        <!-- Estatísticas -->
        <div class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="bg-white rounded-2xl p-4 shadow-lg border border-purple-100 text-center">
                <div class="text-2xl text-purple-600 mb-2">🛍️</div>
                <div class="text-2xl font-bold text-purple-800">{{ $produtos->count() }}</div>
                <div class="text-purple-400 text-sm">Total de Produtos</div>
            </div>
            <div class="bg-white rounded-2xl p-4 shadow-lg border border-purple-100 text-center">
                <div class="text-2xl text-green-600 mb-2">💰</div>
                <div class="text-2xl font-bold text-green-800">
                    R$ {{ number_format($produtos->sum('preco'), 2, ',', '.') }}
                </div>
                <div class="text-green-400 text-sm">Valor Total</div>
            </div>
            <div class="bg-white rounded-2xl p-4 shadow-lg border border-purple-100 text-center">
                <div class="text-2xl text-blue-600 mb-2">📦</div>
                <div class="text-2xl font-bold text-blue-800">{{ $produtos->sum('quantidade') }}</div>
                <div class="text-blue-400 text-sm">Itens em Estoque</div>
            </div>
        </div>
    </div>
</div>