<div class="min-h-screen bg-blue-50 p-6 font-sans">
    
    <!-- Título -->
    <h2 class="text-blue-700 font-bold text-2xl mb-6 border-b pb-2 border-blue-200">
        ✏️ Editar Produto
    </h2>

    <!-- Mensagens de Feedback -->
    @if (session()->has('message'))
        <div class="mb-6 p-4 bg-green-100 border-l-4 border-green-500 text-green-800 rounded-lg shadow-md flex items-center gap-3">
            <span class="text-xl">✅</span>
            <span>{{ session('message') }}</span>
        </div>
    @endif

    @if ($errors->any())
        <div class="mb-6 p-4 bg-red-100 border-l-4 border-red-500 text-red-800 rounded-lg shadow-md">
            <h4 class="font-semibold mb-2 flex items-center gap-2"><span class="text-xl">❌</span> Erros encontrados:</h4>
            <ul class="list-disc ml-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Formulário Principal -->
    <div class="bg-white p-8 rounded-xl shadow-xl border border-blue-100 mb-6">
        
        <form wire:submit.prevent="update" class="space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                
                <!-- Nome do Produto -->
                <div>
                    <label for="nome" class="block text-sm font-medium text-blue-700 mb-1">Nome do Produto</label>
                    <input type="text" wire:model="nome" id="nome" 
                           class="p-3 border border-blue-300 rounded-lg w-full focus:ring-blue-500 focus:border-blue-500 transition duration-150 ease-in-out"
                           placeholder="Ex: Camiseta Básica">
                    @error('nome') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                </div>

                <!-- Descrição -->
                <div>
                    <label for="descricao" class="block text-sm font-medium text-blue-700 mb-1">Descrição</label>
                    <input type="text" wire:model="descricao" id="descricao" 
                           class="p-3 border border-blue-300 rounded-lg w-full focus:ring-blue-500 focus:border-blue-500 transition duration-150 ease-in-out"
                           placeholder="Detalhes do produto">
                    @error('descricao') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                </div>

                <!-- Preço -->
                <div>
                    <label for="preco" class="block text-sm font-medium text-blue-700 mb-1">Preço (R$)</label>
                    <input type="number" wire:model="preco" id="preco" step="0.01"
                           class="p-3 border border-blue-300 rounded-lg w-full focus:ring-blue-500 focus:border-blue-500 transition duration-150 ease-in-out"
                           placeholder="0.00">
                    @error('preco') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                </div>

                <!-- Quantidade -->
                <div>
                    <label for="quantidade" class="block text-sm font-medium text-blue-700 mb-1">Quantidade em Estoque</label>
                    <input type="number" wire:model="quantidade" id="quantidade"
                           class="p-3 border border-blue-300 rounded-lg w-full focus:ring-blue-500 focus:border-blue-500 transition duration-150 ease-in-out"
                           placeholder="0">
                    @error('quantidade') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                </div>

                <!-- Quantidade Mínima -->
                <div class="md:col-span-2">
                    <label for="quantidade_minima" class="block text-sm font-medium text-blue-700 mb-1">Quantidade Mínima de Alerta</label>
                    <input type="number" wire:model="quantidade_minima" id="quantidade_minima"
                           class="p-3 border border-blue-300 rounded-lg w-full focus:ring-blue-500 focus:border-blue-500 transition duration-150 ease-in-out"
                           placeholder="0">
                    @error('quantidade_minima') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                </div>
            </div>

            <!-- Botões de Ação -->
            <div class="mt-6 flex space-x-3">
                <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg shadow-md transition duration-150 ease-in-out flex items-center gap-2">
                    <span>💾</span>
                    <span>Atualizar Produto</span>
                </button>
                
                <a href="{{ route('produtos.index') }}" 
                   class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-3 px-6 rounded-lg shadow-md transition duration-150 ease-in-out flex items-center gap-2">
                    <span>←</span>
                    <span>Voltar</span>
                </a>
            </div>
        </form>
    </div>
</div>
