<div class="min-h-screen bg-gradient-to-br from-purple-50 to-pink-50 p-6 font-sans">
    <div class="max-w-2xl mx-auto">
        
        <!-- Cabeçalho Bonito -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-white rounded-full shadow-lg mb-4 border border-purple-200">
                <span class="text-3xl">📦</span>
            </div>
            <h2 class="text-4xl font-bold bg-gradient-to-r from-purple-600 to-pink-600 bg-clip-text text-transparent mb-3">
                Nova Movimentação
            </h2>
            <p class="text-purple-500 text-lg">Adicione produtos ao estoque</p>
        </div>

        <!-- Card do Formulário -->
        <div class="bg-white rounded-3xl shadow-2xl p-8 border border-purple-100">
            <form wire:submit.prevent="salvar" class="space-y-6">
                
                <!-- Produto -->
                <div class="space-y-2">
                    <label for="produto_id" class="block text-sm font-semibold text-purple-700 mb-2 flex items-center gap-2">
                        <span class="w-6 h-6 bg-purple-100 rounded-full flex items-center justify-center text-purple-600">🛍️</span>
                        Selecione o Produto
                    </label>
                    <select wire:model="produto_id" id="produto_id" 
                            class="w-full px-4 py-4 rounded-2xl border-2 border-purple-200 focus:border-purple-500 focus:ring-2 focus:ring-purple-200 transition-all bg-white text-purple-800 font-medium">
                        <option value="" class="text-gray-400">🎯 Escolha um produto...</option>
                        @foreach ($produtos as $produto)
                            <option value="{{ $produto->id }}" class="text-purple-800 py-2">
                                {{ $produto->nome }} 
                                <span class="text-purple-400">• Estoque: {{ $produto->quantidade }}</span>
                            </option>
                        @endforeach
                    </select>
                    @error('produto_id') 
                        <div class="flex items-center gap-2 text-red-500 text-sm mt-2">
                            <span>⚠️</span>
                            <span>{{ $message }}</span>
                        </div>
                    @enderror
                </div>

                <!-- ✅ TIPO DE MOVIMENTAÇÃO (ADICIONADO) -->
                <div class="space-y-2">
                    <label class="block text-sm font-semibold text-purple-700 mb-2 flex items-center gap-2">
                        <span class="w-6 h-6 bg-purple-100 rounded-full flex items-center justify-center text-purple-600">🔄</span>
                        Tipo de Movimentação
                    </label>
                    <div class="grid grid-cols-2 gap-4">
                        <label class="flex items-center p-4 border-2 border-green-200 rounded-xl cursor-pointer hover:bg-green-50 transition-colors {{ $tipo === 'entrada' ? 'bg-green-100 border-green-500' : '' }}">
                            <input type="radio" wire:model="tipo" value="entrada" class="text-green-500 focus:ring-green-500">
                            <span class="ml-3 text-green-700 font-medium">
                                ➕ Entrada
                            </span>
                        </label>
                        <label class="flex items-center p-4 border-2 border-red-200 rounded-xl cursor-pointer hover:bg-red-50 transition-colors {{ $tipo === 'saida' ? 'bg-red-100 border-red-500' : '' }}">
                            <input type="radio" wire:model="tipo" value="saida" class="text-red-500 focus:ring-red-500">
                            <span class="ml-3 text-red-700 font-medium">
                                ➖ Saída
                            </span>
                        </label>
                    </div>
                    @error('tipo') 
                        <div class="flex items-center gap-2 text-red-500 text-sm mt-2">
                            <span>⚠️</span>
                            <span>{{ $message }}</span>
                        </div>
                    @enderror
                </div>

                <!-- Quantidade -->
                <div class="space-y-2">
                    <label for="quantidade" class="block text-sm font-semibold text-purple-700 mb-2 flex items-center gap-2">
                        <span class="w-6 h-6 bg-purple-100 rounded-full flex items-center justify-center text-purple-600">📊</span>
                        Quantidade
                    </label>
                    <div class="relative">
                        <input type="number" wire:model="quantidade" id="quantidade" 
                               class="w-full px-4 py-4 rounded-2xl border-2 border-purple-200 focus:border-purple-500 focus:ring-2 focus:ring-purple-200 transition-all pl-12"
                               placeholder="0" min="1">
                        <div class="absolute left-4 top-1/2 transform -translate-y-1/2 text-purple-400">
                            🔢
                        </div>
                    </div>
                    @error('quantidade') 
                        <div class="flex items-center gap-2 text-red-500 text-sm mt-2">
                            <span>⚠️</span>
                            <span>{{ $message }}</span>
                        </div>
                    @enderror
                </div>

                <!-- Data da Movimentação -->
                <div class="space-y-2">
                    <label for="data_movimentacao" class="block text-sm font-semibold text-purple-700 mb-2 flex items-center gap-2">
                        <span class="w-6 h-6 bg-purple-100 rounded-full flex items-center justify-center text-purple-600">📅</span>
                        Data da Movimentação
                    </label>
                    <div class="relative">
                        <input type="date" wire:model="data_movimentacao" id="data_movimentacao"
                               class="w-full px-4 py-4 rounded-2xl border-2 border-purple-200 focus:border-purple-500 focus:ring-2 focus:ring-purple-200 transition-all pl-12">
                        <div class="absolute left-4 top-1/2 transform -translate-y-1/2 text-purple-400">
                            📅
                        </div>
                    </div>
                    @error('data_movimentacao') 
                        <div class="flex items-center gap-2 text-red-500 text-sm mt-2">
                            <span>⚠️</span>
                            <span>{{ $message }}</span>
                        </div>
                    @enderror
                </div>

                <!-- Observação -->
                <div class="space-y-2">
                    <label for="observacao" class="block text-sm font-semibold text-purple-700 mb-2 flex items-center gap-2">
                        <span class="w-6 h-6 bg-purple-100 rounded-full flex items-center justify-center text-purple-600">📝</span>
                        Observação <span class="text-purple-400 text-xs font-normal">(opcional)</span>
                    </label>
                    <div class="relative">
                        <textarea wire:model="observacao" id="observacao" rows="3"
                                  class="w-full px-4 py-4 rounded-2xl border-2 border-purple-200 focus:border-purple-500 focus:ring-2 focus:ring-purple-200 transition-all pl-12"
                                  placeholder="Motivo da movimentação, nota fiscal, etc..."></textarea>
                        <div class="absolute left-4 top-4 transform text-purple-400">
                            📝
                        </div>
                    </div>
                    @error('observacao') 
                        <div class="flex items-center gap-2 text-red-500 text-sm mt-2">
                            <span>⚠️</span>
                            <span>{{ $message }}</span>
                        </div>
                    @enderror
                </div>

                <!-- Botões -->
                <div class="flex flex-col sm:flex-row gap-4 pt-6">
                    <button type="submit" 
                            class="flex-1 bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 text-white py-4 px-8 rounded-2xl font-bold transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl flex items-center justify-center gap-3 group">
                        <span class="group-hover:scale-110 transition-transform">💾</span>
                        <span>Salvar Movimentação</span>
                    </button>
                    <a href="{{ route('estoques.index') }}" 
                       class="flex-1 bg-gradient-to-r from-gray-500 to-gray-600 hover:from-gray-600 hover:to-gray-700 text-white py-4 px-8 rounded-2xl font-bold transition-all duration-300 text-center flex items-center justify-center gap-3 group">
                        <span class="group-hover:scale-110 transition-transform">←</span>
                        <span>Voltar</span>
                    </a>
                </div>
            </form>
        </div>

        <!-- Mensagem de Sucesso -->
        @if (session('success'))
            <div class="mt-6 bg-gradient-to-r from-green-100 to-emerald-100 border-l-4 border-green-500 text-green-800 p-6 rounded-2xl shadow-lg">
                <div class="flex items-center gap-3">
                    <span class="text-2xl">🎉</span>
                    <div>
                        <p class="font-bold text-lg">Sucesso!</p>
                        <p>{{ session('success') }}</p>
                    </div>
                </div>
            </div>
        @endif

        <!-- Preview -->
        @if($produto_id && $quantidade)
        <div class="mt-8 bg-gradient-to-r from-purple-50 to-blue-50 p-6 rounded-2xl border-2 border-purple-200 shadow-lg">
            <h3 class="text-xl font-bold text-purple-800 mb-4 flex items-center gap-2">
                <span>👀</span>
                Preview da Movimentação
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                <div class="flex items-center gap-3 p-3 bg-white rounded-xl shadow-sm">
                    <span class="text-purple-500">🛍️</span>
                    <div>
                        <div class="text-purple-600 text-xs">Produto</div>
                        <div class="font-bold text-purple-800">
                            {{ $produtos->firstWhere('id', $produto_id)->nome ?? '' }}
                        </div>
                    </div>
                </div>
                <div class="flex items-center gap-3 p-3 bg-white rounded-xl shadow-sm">
                    <span class="{{ $tipo === 'entrada' ? 'text-green-500' : 'text-red-500' }}">🔄</span>
                    <div>
                        <div class="text-purple-600 text-xs">Tipo</div>
                        <div class="font-bold {{ $tipo === 'entrada' ? 'text-green-600' : 'text-red-600' }}">
                            {{ $tipo === 'entrada' ? 'Entrada' : 'Saída' }}
                        </div>
                    </div>
                </div>
                <div class="flex items-center gap-3 p-3 bg-white rounded-xl shadow-sm">
                    <span class="text-green-500">📦</span>
                    <div>
                        <div class="text-purple-600 text-xs">Quantidade</div>
                        <div class="font-bold text-purple-800">{{ $quantidade }} unidades</div>
                    </div>
                </div>
                <div class="flex items-center gap-3 p-3 bg-white rounded-xl shadow-sm">
                    <span class="text-blue-500">📅</span>
                    <div>
                        <div class="text-purple-600 text-xs">Data</div>
                        <div class="font-bold text-purple-800">
                            {{ $data_movimentacao ? \Carbon\Carbon::parse($data_movimentacao)->format('d/m/Y') : 'Hoje' }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <!-- Dica -->
        <div class="mt-6 text-center">
            <p class="text-purple-400 text-sm flex items-center justify-center gap-2">
                <span>💡</span>
                Preencha os campos acima para registrar movimentações de estoque
            </p>
        </div>
    </div>
</div>