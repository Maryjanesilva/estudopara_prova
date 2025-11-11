<div class="min-h-screen bg-gradient-to-br from-cyan-50 via-white to-sky-50 flex items-center justify-center p-4 font-sans">
    <div class="max-w-md w-full">
        
        <!-- Card de Recuperação de Senha -->
        <div class="bg-white rounded-3xl shadow-2xl p-8 border border-cyan-100">
            
            <!-- Cabeçalho -->
            <div class="text-center mb-8">
                <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-r from-cyan-600 to-blue-600 rounded-full shadow-lg mb-4">
                    <span class="text-3xl text-white">🔑</span>
                </div>
                <h2 class="text-3xl font-bold bg-gradient-to-r from-cyan-600 to-blue-600 bg-clip-text text-transparent mb-2">
                    Recuperar Senha
                </h2>
                <p class="text-cyan-500">Digite seu email para redefinir sua senha</p>
            </div>

            <!-- Mensagens -->
            @if($message)
                <div class="mb-6 bg-gradient-to-r from-green-100 to-emerald-100 border-l-4 border-green-500 text-green-800 p-4 rounded-2xl shadow">
                    <div class="flex items-center gap-3">
                        <span class="text-xl">✅</span>
                        <span class="font-medium">{{ $message }}</span>
                    </div>
                </div>
            @endif

            @if($error)
                <div class="mb-6 bg-gradient-to-r from-red-100 to-pink-100 border-l-4 border-red-500 text-red-800 p-4 rounded-2xl shadow">
                    <div class="flex items-center gap-3">
                        <span class="text-xl">❌</span>
                        <span class="font-medium">{{ $error }}</span>
                    </div>
                </div>
            @endif

            <!-- Formulário -->
            <form wire:submit.prevent="sendResetLink" class="space-y-6">
                
                <!-- Email -->
                <div class="space-y-2">
                    <label for="email" class="block text-sm font-semibold text-cyan-700 mb-2 flex items-center gap-2">
                        <span class="w-5 h-5 bg-cyan-100 rounded-full flex items-center justify-center text-cyan-600 text-xs">📧</span>
                        Email Cadastrado
                    </label>
                    <div class="relative">
                        <input type="email" wire:model="email" id="email"
                               class="w-full px-4 py-4 rounded-2xl border-2 border-cyan-200 focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 transition-all pl-12 bg-white text-cyan-800 font-medium"
                               placeholder="seu@email.com"
                               autocomplete="email"
                               autofocus>
                        <div class="absolute left-4 top-1/2 transform -translate-y-1/2 text-cyan-400">
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

                <!-- Botão de Enviar -->
                <button type="submit" 
                        class="w-full bg-gradient-to-r from-cyan-600 to-blue-600 hover:from-cyan-700 hover:to-blue-700 text-white py-4 px-8 rounded-2xl font-bold transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl flex items-center justify-center gap-3 group">
                    <span class="group-hover:scale-110 transition-transform">🔑</span>
                    <span>Enviar Link de Recuperação</span>
                </button>
            </form>

            <!-- Links -->
            <div class="mt-6 text-center space-y-3">
                <a href="{{ route('login') }}" 
                   class="text-cyan-600 hover:text-cyan-800 font-medium transition-colors flex items-center justify-center gap-2">
                    <span>←</span>
                    <span>Voltar para o Login</span>
                </a>
                
                <div class="border-t border-cyan-200 pt-4">
                    <p class="text-cyan-400 text-sm">
                        Não consegue acessar seu email? 
                        <a href="#" class="text-cyan-600 hover:text-cyan-800 font-medium">
                            Entre em contato com o suporte
                        </a>
                    </p>
                </div>
            </div>

            <!-- Informações -->
            <div class="mt-6 p-4 bg-cyan-50 rounded-2xl border border-cyan-200">
                <div class="text-center text-sm text-cyan-600">
                    <p class="font-semibold mb-2">💡 Como funciona:</p>
                    <ul class="text-xs space-y-1 text-left">
                        <li>• Digite o email cadastrado na sua conta</li>
                        <li>• Enviaremos um link para redefinir sua senha</li>
                        <li>• O link expira em 1 hora por segurança</li>
                        <li>• Verifique sua pasta de spam se não encontrar</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="text-center mt-6">
            <p class="text-cyan-400 text-sm">
                © {{ date('Y') }} ModaExpress - Sistema de Gestão
            </p>
        </div>
    </div>
</div>
