<div class="min-h-screen bg-gray-100 p-6 font-sans">
    <div class="max-w-2xl mx-auto">
        
        <!-- Cabeçalho Bonito -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-white rounded-full shadow-lg mb-4 border border-blue-300">
                <span class="text-3xl">👥</span>
            </div>
            <h2 class="text-4xl font-bold text-blue-800 mb-3">
                Novo Usuário
            </h2>
            <p class="text-blue-600 text-lg">Cadastre um novo usuário no sistema</p>
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
                
                <!-- Nome -->
                <div class="space-y-2">
                    <label for="nome" class="block text-sm font-semibold text-gray-700 mb-2 flex items-center gap-2">
                        <span class="w-6 h-6 bg-blue-100 rounded-full flex items-center justify-center text-blue-600">👤</span>
                        Nome Completo
                    </label>
                    <div class="relative">
                        <input type="text" wire:model="nome" id="nome"
                               class="w-full px-4 py-3 rounded-lg border-2 border-blue-300 focus:border-blue-700 focus:ring-2 focus:ring-blue-200 transition-all pl-12 bg-white text-gray-800 font-medium"
                               placeholder="Digite o nome completo"
                               autocomplete="name"
                               autofocus>
                        <div class="absolute left-4 top-1/2 transform -translate-y-1/2 text-blue-400">
                            👤
                        </div>
                    </div>
                    @error('nome') 
                        <div class="flex items-center gap-2 text-red-500 text-sm mt-2">
                            <span>⚠️</span>
                            <span>{{ $message }}</span>
                        </div>
                    @enderror
                </div>

                <!-- Email -->
                <div class="space-y-2">
                    <label for="email" class="block text-sm font-semibold text-gray-700 mb-2 flex items-center gap-2">
                        <span class="w-6 h-6 bg-blue-100 rounded-full flex items-center justify-center text-blue-600">📧</span>
                        Email
                    </label>
                    <div class="relative">
                        <input type="email" wire:model="email" id="email"
                               class="w-full px-4 py-3 rounded-lg border-2 border-blue-300 focus:border-blue-700 focus:ring-2 focus:ring-blue-200 transition-all pl-12 bg-white text-gray-800 font-medium"
                               placeholder="exemplo@email.com"
                               autocomplete="email">
                        <div class="absolute left-4 top-1/2 transform -translate-y-1/2 text-blue-400">
                            📧
                        </div>
                    </div>
                    @error('email') 
                        <div class="flex items-center gap-2 text-red-500 text-sm mt-2">
                            <span>⚠️</span>
                            <span>{{ $message }}</span>
                        </div>
                    @enderror
                </div>

                <!-- Senha -->
                <div class="space-y-2">
                    <label for="senha" class="block text-sm font-semibold text-gray-700 mb-2 flex items-center gap-2">
                        <span class="w-6 h-6 bg-blue-100 rounded-full flex items-center justify-center text-blue-600">🔒</span>
                        Senha
                    </label>
                    <div class="relative">
                        <input type="password" wire:model="senha" id="senha"
                               class="w-full px-4 py-3 rounded-lg border-2 border-blue-300 focus:border-blue-700 focus:ring-2 focus:ring-blue-200 transition-all pl-12 bg-white text-gray-800 font-medium"
                               placeholder="Digite uma senha segura"
                               autocomplete="new-password">
                        <div class="absolute left-4 top-1/2 transform -translate-y-1/2 text-blue-400">
                            🔒
                        </div>
                    </div>
                    @error('senha') 
                        <div class="flex items-center gap-2 text-red-500 text-sm mt-2">
                            <span>⚠️</span>
                            <span>{{ $message }}</span>
                        </div>
                    @enderror
                </div>

                <!-- Dicas de Senha -->
                <div class="bg-blue-50 p-4 rounded-lg border border-blue-200">
                    <p class="text-sm text-blue-700 font-semibold mb-2 flex items-center gap-2">
                        <span>💡</span>
                        Dicas para uma senha segura:
                    </p>
                    <ul class="text-xs text-blue-600 space-y-1">
                        <li>• Mínimo 6 caracteres</li>
                        <li>• Use letras, números e símbolos</li>
                        <li>• Evite senhas óbvias como "123456"</li>
                    </ul>
                </div>

                <!-- Botões -->
                <div class="flex flex-col sm:flex-row gap-4 pt-6">
                    <button type="submit" 
                            class="flex-1 bg-blue-700 hover:bg-blue-800 text-white py-3 px-8 rounded-lg font-bold transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl flex items-center justify-center gap-3 group">
                        <span class="group-hover:scale-110 transition-transform">👤</span>
                        <span>Cadastrar Usuário</span>
                    </button>
                    <a href="{{ route('usuarios.index') }}" 
                       class="flex-1 bg-gray-300 hover:bg-gray-400 text-gray-800 py-3 px-8 rounded-lg font-bold transition-all duration-300 text-center flex items-center justify-center gap-3 group">
                        <span class="group-hover:scale-110 transition-transform">←</span>
                        <span>Voltar à Lista</span>
                    </a>
                </div>
            </form>
        </div>

        <!-- Preview do Usuário -->
        @if($nome || $email)
        <div class="mt-8 bg-blue-50 p-6 rounded-xl border-2 border-blue-200 shadow-lg">
            <h3 class="text-xl font-bold text-blue-800 mb-4 flex items-center gap-2">
                <span>👀</span>
                Preview do Usuário
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                <div class="flex items-center gap-3 p-3 bg-white rounded-lg shadow-sm">
                    <span class="text-blue-500">👤</span>
                    <div>
                        <div class="text-blue-600 text-xs">Nome</div>
                        <div class="font-bold text-blue-800">{{ $nome ?: 'Não informado' }}</div>
                    </div>
                </div>
                <div class="flex items-center gap-3 p-3 bg-white rounded-lg shadow-sm">
                    <span class="text-green-500">📧</span>
                    <div>
                        <div class="text-blue-600 text-xs">Email</div>
                        <div class="font-bold text-blue-800">{{ $email ?: 'Não informado' }}</div>
                    </div>
                </div>
            </div>
        </div>
        @endif

    </div>
</div>
