{{-- resources/views/auth/reset-password-form.blade.php --}}

<div class="min-h-screen bg-gradient-to-br from-purple-50 via-white to-pink-50 flex items-center justify-center p-4 font-sans">
    <div class="max-w-md w-full">
        
        <!-- Card de Redefinição de Senha -->
        <div class="bg-white rounded-3xl shadow-2xl p-8 border border-purple-100">
            
            <!-- Cabeçalho -->
            <div class="text-center mb-8">
                <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-r from-purple-600 to-pink-600 rounded-full shadow-lg mb-4">
                    <span class="text-3xl text-white">🔒</span>
                </div>
                <h2 class="text-3xl font-bold bg-gradient-to-r from-purple-600 to-pink-600 bg-clip-text text-transparent mb-2">
                    Definir Nova Senha
                </h2>
                <p class="text-purple-500">Digite e confirme sua nova senha de acesso.</p>
            </div>

            <!-- Mensagens -->
            {{-- Usando as propriedades do Livewire $message e $error --}}
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
            <form wire:submit.prevent="resetPassword" class="space-y-6">
                
                {{-- Campos ocultos para manter o email e o token no estado do Livewire --}}
                <input type="hidden" wire:model="token">
                <input type="hidden" wire:model="email">

                <!-- Nova Senha -->
                <div class="space-y-2">
                    <label for="password" class="block text-sm font-semibold text-purple-700 mb-2">
                        Nova Senha
                    </label>
                    <input type="password" wire:model="password" id="password"
                           class="w-full px-4 py-3 rounded-2xl border-2 border-purple-200 focus:border-purple-500 transition-all text-purple-800 font-medium"
                           placeholder="********">
                    @error('password') 
                        <div class="flex items-center gap-2 text-red-500 text-sm mt-2">
                            <span>⚠️</span><span>{{ $message }}</span>
                        </div>
                    @enderror
                </div>

                <!-- Confirmação de Senha -->
                <div class="space-y-2">
                    <label for="password_confirmation" class="block text-sm font-semibold text-purple-700 mb-2">
                        Confirme a Nova Senha
                    </label>
                    <input type="password" wire:model="password_confirmation" id="password_confirmation"
                           class="w-full px-4 py-3 rounded-2xl border-2 border-purple-200 focus:border-purple-500 transition-all text-purple-800 font-medium"
                           placeholder="********">
                </div>

                <!-- Botão de Redefinir -->
                <button type="submit" 
                        class="w-full bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 text-white py-4 px-8 rounded-2xl font-bold transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl flex items-center justify-center gap-3 group">
                    <span>🔄</span>
                    <span>Redefinir e Entrar</span>
                </button>
            </form>

            <!-- Links -->
            <div class="mt-6 text-center">
                <a href="{{ route('login') }}" 
                   class="text-purple-600 hover:text-purple-800 font-medium transition-colors flex items-center justify-center gap-2">
                    <span>←</span>
                    <span>Voltar para o Login</span>
                </a>
            </div>
            
            <!-- Informações -->
            <div class="mt-6 p-4 bg-purple-50 rounded-2xl border border-purple-200">
                <div class="text-center text-sm text-purple-600">
                    <p class="font-semibold mb-2">🔒 Requisitos de Senha:</p>
                    <ul class="text-xs space-y-1 text-left">
                        <li>• Mínimo de 8 caracteres</li>
                        <li>• Letras maiúsculas e minúsculas</li>
                        <li>• Pelo menos um número e um símbolo</li>
                    </ul>
                </div>
            </div>

        </div>
    </div>
</div>

