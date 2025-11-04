{{-- ✅ APENAS UM ELEMENTO RAIZ --}}
<div class="min-h-screen bg-gradient-to-br from-purple-50 via-white to-pink-50 flex items-center justify-center p-4 font-sans">
    <div class="max-w-md w-full">
        
        <!-- Card de Login -->
        <div class="bg-white rounded-3xl shadow-2xl p-8 border border-purple-100">
            
            <!-- Cabeçalho -->
            <div class="text-center mb-8">
                <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-r from-purple-600 to-pink-600 rounded-full shadow-lg mb-4">
                    <span class="text-3xl text-white">🛍️</span>
                </div>
                <h2 class="text-3xl font-bold bg-gradient-to-r from-purple-600 to-pink-600 bg-clip-text text-transparent mb-2">
                    ModaExpress
                </h2>
                <p class="text-purple-500">Faça login para acessar o sistema</p>
            </div>

            <!-- Mensagens de Erro -->
            @if($erro)
                <div class="mb-6 bg-gradient-to-r from-red-100 to-pink-100 border-l-4 border-red-500 text-red-800 p-4 rounded-2xl shadow">
                    <div class="flex items-center gap-3">
                        <span class="text-xl">❌</span>
                        <span class="font-medium">{{ $erro }}</span>
                    </div>
                </div>
            @endif

            @if(session('success'))
                <div class="mb-6 bg-gradient-to-r from-green-100 to-emerald-100 border-l-4 border-green-500 text-green-800 p-4 rounded-2xl shadow">
                    <div class="flex items-center gap-3">
                        <span class="text-xl">✅</span>
                        <span class="font-medium">{{ session('success') }}</span>
                    </div>
                </div>
            @endif

            <!-- Formulário -->
            <form wire:submit.prevent="login" class="space-y-6">
                
                <!-- Email -->
                <div class="space-y-2">
                    <label for="email" class="block text-sm font-semibold text-purple-700 mb-2 flex items-center gap-2">
                        <span class="w-5 h-5 bg-purple-100 rounded-full flex items-center justify-center text-purple-600 text-xs">📧</span>
                        Email
                    </label>
                    <div class="relative">
                        <input type="email" wire:model="email" id="email"
                               class="w-full px-4 py-4 rounded-2xl border-2 border-purple-200 focus:border-purple-500 focus:ring-2 focus:ring-purple-200 transition-all pl-12 bg-white text-purple-800 font-medium"
                               placeholder="seu@email.com"
                               autocomplete="email"
                               autofocus>
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
                        <span class="w-5 h-5 bg-purple-100 rounded-full flex items-center justify-center text-purple-600 text-xs">🔒</span>
                        Senha
                    </label>
                    <div class="relative">
                        <input type="password" wire:model="senha" id="senha"
                               class="w-full px-4 py-4 rounded-2xl border-2 border-purple-200 focus:border-purple-500 focus:ring-2 focus:ring-purple-200 transition-all pl-12 bg-white text-purple-800 font-medium"
                               placeholder="Sua senha"
                               autocomplete="current-password">
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

                <!-- Lembrar de mim -->
                <div class="flex items-center justify-between">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" wire:model="lembrar" 
                               class="rounded border-purple-300 text-purple-600 focus:ring-purple-500">
                        <span class="text-sm text-purple-700">Lembrar de mim</span>
                    </label>
                    
                    <a href="#" class="text-sm text-purple-600 hover:text-purple-800 transition-colors">
                        Esqueceu a senha?
                    </a>
                </div>

                <!-- Botão de Login -->
                <button type="submit" 
                        class="w-full bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 text-white py-4 px-8 rounded-2xl font-bold transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl flex items-center justify-center gap-3 group">
                    <span class="group-hover:scale-110 transition-transform">🔑</span>
                    <span>Entrar no Sistema</span>
                </button>
            </form>

            <!-- Dicas -->
            <div class="mt-6 p-4 bg-purple-50 rounded-2xl border border-purple-200">
                <div class="text-center text-sm text-purple-600">
                    <p class="font-semibold mb-2">💡 Dicas de acesso:</p>
                    <p class="text-xs">Use o email: <span class="font-mono bg-white px-2 py-1 rounded">admin@modaexpress.com</span></p>
                    <p class="text-xs">Senha: <span class="font-mono bg-white px-2 py-1 rounded">123456</span></p>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="text-center mt-6">
            <p class="text-purple-400 text-sm">
                © {{ date('Y') }} ModaExpress - Sistema de Gestão
            </p>
        </div>
    </div>
</div>