<div class="min-h-screen bg-gradient-to-br from-purple-50 via-white to-pink-50 p-6 font-sans">
    <div class="max-w-2xl mx-auto">
        
        <!-- Cabeçalho Bonito -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-white rounded-full shadow-lg mb-4 border border-purple-200">
                <span class="text-3xl">👥</span>
            </div>
            <h2 class="text-4xl font-bold bg-gradient-to-r from-purple-600 to-pink-600 bg-clip-text text-transparent mb-3">
                Novo Usuário
            </h2>
            <p class="text-purple-500 text-lg">Cadastre um novo usuário no sistema</p>
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
                
                <!-- Nome -->
                <div class="space-y-2">
                    <label for="nome" class="block text-sm font-semibold text-purple-700 mb-2 flex items-center gap-2">
                        <span class="w-6 h-6 bg-purple-100 rounded-full flex items-center justify-center text-purple-600">👤</span>
                        Nome Completo
                    </label>
                    <div class="relative">
                        <input type="text" wire:model="nome" id="nome"
                               class="w-full px-4 py-4 rounded-2xl border-2 border-purple-200 focus:border-purple-500 focus:ring-2 focus:ring-purple-200 transition-all pl-12 bg-white text-purple-800 font-medium"
                               placeholder="Digite o nome completo"
                               autocomplete="name"
                               autofocus>
                        <div class="absolute left-4 top-1/2 transform -translate-y-1/2 text-purple-400">
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
                    <label for="email" class="block text-sm font-semibold text-purple-700 mb-2 flex items-center gap-2">
                        <span class="w-6 h-6 bg-purple-100 rounded-full flex items-center justify-center text-purple-600">📧</span>
                        Email
                    </label>
                    <div class="relative">
                        <input type="email" wire:model="email" id="email"
                               class="w-full px-4 py-4 rounded-2xl border-2 border-purple-200 focus:border-purple-500 focus:ring-2 focus:ring-purple-200 transition-all pl-12 bg-white text-purple-800 font-medium"
                               placeholder="exemplo@email.com"
                               autocomplete="email">
                        <div class="absolute left-4 top-1/2 transform -translate-y-1/2 text-purple-400">
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
                    <label for="senha" class="block text-sm font-semibold text-purple-700 mb-2 flex items-center gap-2">
                        <span class="w-6 h-6 bg-purple-100 rounded-full flex items-center justify-center text-purple-600">🔒</span>
                        Senha
                    </label>
                    <div class="relative">
                        <input type="password" wire:model="senha" id="senha"
                               class="w-full px-4 py-4 rounded-2xl border-2 border-purple-200 focus:border-purple-500 focus:ring-2 focus:ring-purple-200 transition-all pl-12 bg-white text-purple-800 font-medium"
                               placeholder="Digite uma senha segura"
                               autocomplete="new-password">
                        <div class="absolute left-4 top-1/2 transform -translate-y-1/2 text-purple-400">
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
                <div class="bg-purple-50 p-4 rounded-2xl border border-purple-200">
                    <p class="text-sm text-purple-700 font-semibold mb-2 flex items-center gap-2">
                        <span>💡</span>
                        Dicas para uma senha segura:
                    </p>
                    <ul class="text-xs text-purple-600 space-y-1">
                        <li>• Mínimo 6 caracteres</li>
                        <li>• Use letras, números e símbolos</li>
                        <li>• Evite senhas óbvias como "123456"</li>
                    </ul>
                </div>

                <!-- Botões -->
                <div class="flex flex-col sm:flex-row gap-4 pt-6">
                    <button type="submit" 
                            class="flex-1 bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 text-white py-4 px-8 rounded-2xl font-bold transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl flex items-center justify-center gap-3 group">
                        <span class="group-hover:scale-110 transition-transform">👤</span>
                        <span>Cadastrar Usuário</span>
                    </button>
                    <a href="{{ route('usuarios.index') }}" 
                       class="flex-1 bg-gradient-to-r from-gray-500 to-gray-600 hover:from-gray-600 hover:to-gray-700 text-white py-4 px-8 rounded-2xl font-bold transition-all duration-300 text-center flex items-center justify-center gap-3 group">
                        <span class="group-hover:scale-110 transition-transform">←</span>
                        <span>Voltar à Lista</span>
                    </a>
                </div>
            </form>
        </div>

        <!-- Preview do Usuário -->
        @if($nome || $email)
        <div class="mt-8 bg-gradient-to-r from-purple-50 to-blue-50 p-6 rounded-2xl border-2 border-purple-200 shadow-lg">
            <h3 class="text-xl font-bold text-purple-800 mb-4 flex items-center gap-2">
                <span>👀</span>
                Preview do Usuário
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                <div class="flex items-center gap-3 p-3 bg-white rounded-xl shadow-sm">
                    <span class="text-purple-500">👤</span>
                    <div>
                        <div class="text-purple-600 text-xs">Nome</div>
                        <div class="font-bold text-purple-800">{{ $nome ?: 'Não informado' }}</div>
                    </div>
                </div>
                <div class="flex items-center gap-3 p-3 bg-white rounded-xl shadow-sm">
                    <span class="text-green-500">📧</span>
                    <div>
                        <div class="text-purple-600 text-xs">Email</div>
                        <div class="font-bold text-purple-800">{{ $email ?: 'Não informado' }}</div>
                    </div>
                </div>
                @if($senha)
                <div class="flex items-center gap-3 p-3 bg-white rounded-xl shadow-sm">
                    <span class="text-blue-500">🔒</span>
                    <div>
                        <div class="text-purple-600 text-xs">Senha</div>
                        <div class="font-bold text-purple-800">••••••••</div>
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
                Todos os campos são obrigatórios para cadastrar um novo usuário
            </p>
        </div>
    </div>
</div>