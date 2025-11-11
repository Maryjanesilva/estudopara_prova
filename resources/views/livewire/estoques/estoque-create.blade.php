<div class="min-h-screen bg-gradient-to-br from-blue-50 to-cyan-50 p-6 font-sans">
    <div class="max-w-2xl mx-auto">
        
        <!-- Cabeçalho Bonito -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-white rounded-full shadow-lg mb-4 border border-blue-200">
                <span class="text-3xl">📦</span>
            </div>
            <h2 class="text-4xl font-bold bg-gradient-to-r from-blue-600 to-cyan-600 bg-clip-text text-transparent mb-3">
                Nova Movimentação
            </h2>
            <p class="text-blue-500 text-lg">Adicione produtos ao estoque</p>
        </div>

        <!-- Card do Formulário -->
        <div class="bg-white rounded-3xl shadow-2xl p-8 border border-blue-100">
            <form wire:submit.prevent="salvar" class="space-y-6">
                
                <!-- Produto -->
                <div class="space-y-2">
                    <label for="produto_id" class="block text-sm font-semibold text-blue-700 mb-2 flex items-center gap-2">
                        <span class="w-6 h-6 bg-blue-100 rounded-full flex items-center justify-center text-blue-600">🛍️</span>
                        Selecione o Produto
                    </label>
                    <select wire:model="produto_id" id="produto_id" 
                            class="w-full px-4 py-4 rounded-2xl border-2 border-blue-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all bg-white text-blue-800 font-medium">
                        <option value="" class="text-gray-400">🎯 Escolha um produto...</option>
                        @foreach ($produtos as $produto)
                            <option value="{{ $produto->id }}" class="text-blue-800 py-2">
                                {{ $produto->nome }} 
                                <span class="text-blue-400">• Estoque: {{ $produto->quantidade }}</span>
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
                    <label class="block text-sm font-semibold text-blue-700 mb-2 flex items-center gap-2">
                        <span class="w-6 h-6 bg-blue-100 rounded-full flex items-center justify-center text-blue-600">🔄</span>
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
                    <label for="quantidade" class="block text-sm font-semibold text-blue-700 mb-2 flex items-center gap-2">
                        <span class="w-6 h-6 bg-blue-100 rounded-full flex items-center justify-center text-blue-600">📊</span>
                        Quantidade
                    </label>
                    <div class="relative">
                        <input type="number" wire:model="quantidade" id="quantidade" 
                               class="w-full px-4 py-4 rounded-2xl border-2 border-blue-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all pl-12"
                               placeholder="0" min="1">
                        <div class="absolute left-4 top-1/2 transform -translate-y-1/2 text-blue-400">
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
                    <label for="data_movimentacao" class="block text-sm font-semibold text-blue-700 mb-2 flex items-center gap-2">
                        <span class="w-6 h-6 bg-blue-100 rounded-full flex items-center justify-center text-blue-600">📅</span>
                        Data da Movimentação
                    </label>
                    <div class="relative">
                        <input type="date" wire:model="data_movimentacao" id="data_movimentacao"
                               class="w-full px-4 py-4 rounded-2xl border-2 border-blue-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all pl-12">
                        <div class="absolute left-4 top-1/2 transform -translate-y-1/2 text-blue-400">
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
                    <label for="observacao" class="block text-sm font-semibold text-blue-700 mb-2 flex items-center gap-2">
                        <span class="w-6 h-6 bg-blue-100 rounded-full flex items-center justify-center text-blue-600">📝</span>
                        Observação <span class="text-blue-400 text-xs font-normal">(opcional)</span>
                    </label>
                    <div class="relative">
                        <textarea wire:model="observacao" id="observacao" rows="3"
                                  class="w-full px-4 py-4 rounded-2xl border-2 border-blue-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all pl-12"
                                  placeholder="Motivo da movimentação, nota fiscal, etc..."></textarea>
                        <div class="absolute left-4 top-4 transform text-blue-400">
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
                <div class="flex flex-col gap-4">
                    <button type="submit" class="w-full bg-gradient-to-r from-blue-600 to-cyan-600 hover:from-blue-700 hover:to-cyan-700 text-white font-bold py-4 px-4 rounded-2xl transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                        ✅ Salvar Movimentação
                    </button>
                    <button type="button" wire:click="cancelar" class="w-full bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold py-3 px-4 rounded-2xl transition-colors">
                        ❌ Cancelar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
