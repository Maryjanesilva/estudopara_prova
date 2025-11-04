<div class="min-h-screen bg-gradient-to-br from-purple-50 via-white to-pink-50 p-6 font-sans">
    <div class="max-w-4xl mx-auto">
        
        <!-- Cabeçalho Bonito -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-white rounded-full shadow-lg mb-4 border border-purple-200">
                <span class="text-3xl">🛍️</span>
            </div>
            <h2 class="text-4xl font-bold bg-gradient-to-r from-purple-600 to-pink-600 bg-clip-text text-transparent mb-3">
                Novo Produto
            </h2>
            <p class="text-purple-500 text-lg">Cadastre um novo produto no catálogo</p>
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

        <!-- Card do Formulário -->
        <div class="bg-white rounded-3xl shadow-2xl p-8 border border-purple-100">
            <form wire:submit.prevent="store" class="space-y-6">
                
                <!-- Nome do Produto -->
                <div class="space-y-2">
                    <label for="nome" class="block text-sm font-semibold text-purple-700 mb-2 flex items-center gap-2">
                        <span class="w-6 h-6 bg-purple-100 rounded-full flex items-center justify-center text-purple-600">🏷️</span>
                        Nome do Produto
                    </label>
                    <div class="relative">
                        <input type="text" wire:model="nome" id="nome"
                               class="w-full px-4 py-4 rounded-2xl border-2 border-purple-200 focus:border-purple-500 focus:ring-2 focus:ring-purple-200 transition-all pl-12 bg-white text-purple-800 font-medium"
                               placeholder="Ex: Camiseta Básica, Calça Jeans..."
                               autocomplete="off"
                               autofocus>
                        <div class="absolute left-4 top-1/2 transform -translate-y-1/2 text-purple-400">
                            🏷️
                        </div>
                    </div>
                    @error('nome') 
                        <div class="flex items-center gap-2 text-red-500 text-sm mt-2">
                            <span>⚠️</span>
                            <span>{{ $message }}</span>
                        </div>
                    @enderror
                </div>

                <!-- Descrição -->
                <div class="space-y-2">
                    <label for="descricao" class="block text-sm font-semibold text-purple-700 mb-2 flex items-center gap-2">
                        <span class="w-6 h-6 bg-purple-100 rounded-full flex items-center justify-center text-purple-600">📝</span>
                        Descrição
                    </label>
                    <div class="relative">
                        <textarea wire:model="descricao" id="descricao" rows="3"
                                  class="w-full px-4 py-4 rounded-2xl border-2 border-purple-200 focus:border-purple-500 focus:ring-2 focus:ring-purple-200 transition-all pl-12 bg-white text-purple-800 font-medium resize-none"
                                  placeholder="Descreva o produto..."></textarea>
                        <div class="absolute left-4 top-4 transform text-purple-400">
                            📝
                        </div>
                    </div>
                    @error('descricao') 
                        <div class="flex items-center gap-2 text-red-500 text-sm mt-2">
                            <span>⚠️</span>
                            <span>{{ $message }}</span>
                        </div>
                    @enderror
                </div>

                <!-- Informações de Preço e Estoque -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Preço -->
                    <div class="space-y-2">
                        <label for="preco" class="block text-sm font-semibold text-purple-700 mb-2 flex items-center gap-2">
                            <span class="w-6 h-6 bg-purple-100 rounded-full flex items-center justify-center text-purple-600">💰</span>
                            Preço (R$)
                        </label>
                        <div class="relative">
                            <input type="number" wire:model="preco" id="preco" step="0.01" min="0"
                                   class="w-full px-4 py-4 rounded-2xl border-2 border-purple-200 focus:border-purple-500 focus:ring-2 focus:ring-purple-200 transition-all pl-12 bg-white text-purple-800 font-medium"
                                   placeholder="0.00">
                            <div class="absolute left-4 top-1/2 transform -translate-y-1/2 text-purple-400">
                                💰
                            </div>
                        </div>
                        @error('preco') 
                            <div class="flex items-center gap-2 text-red-500 text-sm mt-2">
                                <span>⚠️</span>
                                <span>{{ $message }}</span>
                            </div>
                        @enderror
                    </div>

                    <!-- Quantidade -->
                    <div class="space-y-2">
                        <label for="quantidade" class="block text-sm font-semibold text-purple-700 mb-2 flex items-center gap-2">
                            <span class="w-6 h-6 bg-purple-100 rounded-full flex items-center justify-center text-purple-600">📦</span>
                            Quantidade
                        </label>
                        <div class="relative">
                            <input type="number" wire:model="quantidade" id="quantidade" min="0"
                                   class="w-full px-4 py-4 rounded-2xl border-2 border-purple-200 focus:border-purple-500 focus:ring-2 focus:ring-purple-200 transition-all pl-12 bg-white text-purple-800 font-medium"
                                   placeholder="0">
                            <div class="absolute left-4 top-1/2 transform -translate-y-1/2 text-purple-400">
                                📦
                            </div>
                        </div>
                        @error('quantidade') 
                            <div class="flex items-center gap-2 text-red-500 text-sm mt-2">
                                <span>⚠️</span>
                                <span>{{ $message }}</span>
                            </div>
                        @enderror
                    </div>

                    <!-- Quantidade Mínima -->
                    <div class="space-y-2">
                        <label for="quantidade_minima" class="block text-sm font-semibold text-purple-700 mb-2 flex items-center gap-2">
                            <span class="w-6 h-6 bg-purple-100 rounded-full flex items-center justify-center text-purple-600">⚠️</span>
                            Estoque Mínimo
                        </label>
                        <div class="relative">
                            <input type="number" wire:model="quantidade_minima" id="quantidade_minima" min="0"
                                   class="w-full px-4 py-4 rounded-2xl border-2 border-purple-200 focus:border-purple-500 focus:ring-2 focus:ring-purple-200 transition-all pl-12 bg-white text-purple-800 font-medium"
                                   placeholder="0">
                            <div class="absolute left-4 top-1/2 transform -translate-y-1/2 text-purple-400">
                                ⚠️
                            </div>
                        </div>
                        @error('quantidade_minima') 
                            <div class="flex items-center gap-2 text-red-500 text-sm mt-2">
                                <span>⚠️</span>
                                <span>{{ $message }}</span>
                            </div>
                        @enderror
                    </div>
                </div>

                <!-- Dicas -->
                <div class="bg-purple-50 p-4 rounded-2xl border border-purple-200">
                    <p class="text-sm text-purple-700 font-semibold mb-2 flex items-center gap-2">
                        <span>💡</span>
                        Informações importantes:
                    </p>
                    <ul class="text-xs text-purple-600 space-y-1">
                        <li>• <strong>Estoque Mínimo:</strong> Sistema alertará quando estoque chegar neste nível</li>
                        <li>• <strong>Preço:</strong> Use ponto para casas decimais (ex: 29.90)</li>
                        <li>• <strong>Quantidade:</strong> Quantidade inicial em estoque</li>
                    </ul>
                </div>

                <!-- Botões -->
                <div class="flex flex-col sm:flex-row gap-4 pt-6">
                    <button type="submit" 
                            class="flex-1 bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 text-white py-4 px-8 rounded-2xl font-bold transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl flex items-center justify-center gap-3 group">
                        <span class="group-hover:scale-110 transition-transform">🛍️</span>
                        <span>Cadastrar Produto</span>
                    </button>
                    <a href="{{ route('produtos.index') }}" 
                       class="flex-1 bg-gradient-to-r from-gray-500 to-gray-600 hover:from-gray-600 hover:to-gray-700 text-white py-4 px-8 rounded-2xl font-bold transition-all duration-300 text-center flex items-center justify-center gap-3 group">
                        <span class="group-hover:scale-110 transition-transform">←</span>
                        <span>Voltar à Lista</span>
                    </a>
                </div>
            </form>
        </div>

        <!-- Preview do Produto -->
        @if($nome || $preco)
        <div class="mt-8 bg-gradient-to-r from-purple-50 to-blue-50 p-6 rounded-2xl border-2 border-purple-200 shadow-lg">
            <h3 class="text-xl font-bold text-purple-800 mb-4 flex items-center gap-2">
                <span>👀</span>
                Preview do Produto
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 text-sm">
                <div class="flex items-center gap-3 p-3 bg-white rounded-xl shadow-sm">
                    <span class="text-purple-500">🏷️</span>
                    <div>
                        <div class="text-purple-600 text-xs">Nome</div>
                        <div class="font-bold text-purple-800">{{ $nome ?: 'Não informado' }}</div>
                    </div>
                </div>
                <div class="flex items-center gap-3 p-3 bg-white rounded-xl shadow-sm">
                    <span class="text-green-500">💰</span>
                    <div>
                        <div class="text-purple-600 text-xs">Preço</div>
                        <div class="font-bold text-purple-800">
                            @if($preco)
                                R$ {{ number_format($preco, 2, ',', '.') }}
                            @else
                                Não informado
                            @endif
                        </div>
                    </div>
                </div>
                <div class="flex items-center gap-3 p-3 bg-white rounded-xl shadow-sm">
                    <span class="text-blue-500">📦</span>
                    <div>
                        <div class="text-purple-600 text-xs">Quantidade</div>
                        <div class="font-bold text-purple-800">{{ $quantidade ?: '0' }}</div>
                    </div>
                </div>
                @if($descricao)
                <div class="col-span-1 md:col-span-2 lg:col-span-3 flex items-start gap-3 p-3 bg-white rounded-xl shadow-sm">
                    <span class="text-orange-500 mt-1">📝</span>
                    <div class="flex-1">
                        <div class="text-purple-600 text-xs">Descrição</div>
                        <div class="font-bold text-purple-800 text-xs">{{ $descricao }}</div>
                    </div>
                </div>
                @endif
            </div>
        </div>
        @endif

        <!-- Informações Adicionais -->
        <div class="mt-6 text-center">
            <p class="text-purple-400 text-sm flex items-center justify-center gap-2">
                <span>ℹ️</span>
                Preencha todos os campos para cadastrar um novo produto no catálogo
            </p>
        </div>
    </div>
</div>