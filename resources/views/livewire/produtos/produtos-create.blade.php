<div class="min-h-screen bg-gray-100 p-6 font-sans">
    <div class="max-w-4xl mx-auto">
        
        <!-- Cabeçalho Bonito -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-white rounded-full shadow-lg mb-4 border border-blue-300">
                <span class="text-3xl">🛍️</span>
            </div>
            <h2 class="text-4xl font-bold text-blue-800 mb-3">
                Novo Produto
            </h2>
            <p class="text-blue-600 text-lg">Cadastre um novo produto no catálogo</p>
        </div>

        <!-- Mensagens -->
        @if (session()->has('message'))
            <div class="mb-6 bg-green-100 border-l-4 border-green-500 text-green-800 p-4 rounded-lg shadow-md">
                <div class="flex items-center gap-3">
                    <span class="text-2xl">✅</span>
                    <span class="font-medium">{{ session('message') }}</span>
                </div>
            </div>
        @endif

        <!-- Card do Formulário -->
        <div class="bg-white rounded-xl shadow-xl p-8 border border-blue-200">
            <form wire:submit.prevent="store" class="space-y-6">
                
                <!-- Nome do Produto -->
                <div class="space-y-2">
                    <label for="nome" class="block text-sm font-semibold text-gray-700 mb-2 flex items-center gap-2">
                        <span class="w-6 h-6 bg-blue-100 rounded-full flex items-center justify-center text-blue-600">🏷️</span>
                        Nome do Produto
                    </label>
                    <div class="relative">
                        <input type="text" wire:model="nome" id="nome"
                               class="w-full px-4 py-3 rounded-lg border-2 border-blue-300 focus:border-blue-700 focus:ring-2 focus:ring-blue-200 transition-all pl-12 bg-white text-gray-800 font-medium"
                               placeholder="Ex: Camiseta Básica, Calça Jeans..."
                               autocomplete="off"
                               autofocus>
                        <div class="absolute left-4 top-1/2 transform -translate-y-1/2 text-blue-400">
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
                    <label for="descricao" class="block text-sm font-semibold text-gray-700 mb-2 flex items-center gap-2">
                        <span class="w-6 h-6 bg-blue-100 rounded-full flex items-center justify-center text-blue-600">📝</span>
                        Descrição
                    </label>
                    <div class="relative">
                        <textarea wire:model="descricao" id="descricao" rows="3"
                                  class="w-full px-4 py-3 rounded-lg border-2 border-blue-300 focus:border-blue-700 focus:ring-2 focus:ring-blue-200 transition-all pl-12 bg-white text-gray-800 font-medium resize-none"
                                  placeholder="Descreva o produto..."></textarea>
                        <div class="absolute left-4 top-3 transform text-blue-400">
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
                        <label for="preco" class="block text-sm font-semibold text-gray-700 mb-2 flex items-center gap-2">
                            <span class="w-6 h-6 bg-blue-100 rounded-full flex items-center justify-center text-blue-600">💰</span>
                            Preço (R$)
                        </label>
                        <div class="relative">
                            <input type="number" wire:model="preco" id="preco" step="0.01" min="0"
                                   class="w-full px-4 py-3 rounded-lg border-2 border-blue-300 focus:border-blue-700 focus:ring-2 focus:ring-blue-200 transition-all pl-12 bg-white text-gray-800 font-medium"
                                   placeholder="0.00">
                            <div class="absolute left-4 top-1/2 transform -translate-y-1/2 text-blue-400">
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
                        <label for="quantidade" class="block text-sm font-semibold text-gray-700 mb-2 flex items-center gap-2">
                            <span class="w-6 h-6 bg-blue-100 rounded-full flex items-center justify-center text-blue-600">📦</span>
                            Quantidade
                        </label>
                        <div class="relative">
                            <input type="number" wire:model="quantidade" id="quantidade" min="0"
                                   class="w-full px-4 py-3 rounded-lg border-2 border-blue-300 focus:border-blue-700 focus:ring-2 focus:ring-blue-200 transition-all pl-12 bg-white text-gray-800 font-medium"
                                   placeholder="0">
                            <div class="absolute left-4 top-1/2 transform -translate-y-1/2 text-blue-400">
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
                        <label for="quantidade_minima" class="block text-sm font-semibold text-gray-700 mb-2 flex items-center gap-2">
                            <span class="w-6 h-6 bg-blue-100 rounded-full flex items-center justify-center text-blue-600">⚠️</span>
                            Estoque Mínimo
                        </label>
                        <div class="relative">
                            <input type="number" wire:model="quantidade_minima" id="quantidade_minima" min="0"
                                   class="w-full px-4 py-3 rounded-lg border-2 border-blue-300 focus:border-blue-700 focus:ring-2 focus:ring-blue-200 transition-all pl-12 bg-white text-gray-800 font-medium"
                                   placeholder="0">
                            <div class="absolute left-4 top-1/2 transform -translate-y-1/2 text-blue-400">
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

                <!-- Botões de Ação -->
                <div class="flex justify-between items-center mt-6">
                    <a href="{{ route('produtos.index') }}" 
                       class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-3 px-6 rounded-lg shadow-md transition duration-150 ease-in-out flex items-center gap-2">
                        <span>←</span>
                        <span>Voltar</span>
                    </a>
                    
                    <button type="submit" 
                            class="bg-blue-700 hover:bg-blue-800 text-white font-bold py-3 px-8 rounded-lg shadow-lg transition duration-300 transform hover:scale-105 flex items-center gap-2 group">
                        <span class="group-hover:scale-110 transition-transform">➕</span>
                        <span>Cadastrar Produto</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
