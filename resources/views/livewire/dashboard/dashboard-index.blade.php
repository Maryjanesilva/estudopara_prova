<div class="min-h-screen bg-blue-50 p-6 font-sans">
    <!-- Sidebar Navigation -->
    <div class="flex">
        <!-- Sidebar -->
        <div class="bg-blue-800 text-white w-64 min-h-screen p-4">
            <div class="flex items-center space-x-3 mb-8 p-4 border-b border-blue-700">
                <div class="w-10 h-10 bg-blue-600 rounded-full flex items-center justify-center">
                    <span class="font-bold">ME</span>
                </div>
                <h1 class="text-xl font-bold">ModaExpress</h1>
            </div>
            
            <nav class="space-y-1">
                <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 p-3 bg-blue-700 rounded-lg">
                    📊 <span>Dashboard</span>
                </a>
                
                <!-- 🛍️ PRODUTOS - Agora vai para a listagem -->
                <a href="{{ route('produtos.index') }}" class="flex items-center space-x-3 p-3 hover:bg-blue-700 rounded-lg">
                    🛍️ <span>Produtos</span>
                </a>
                
                <!-- 📦 ESTOQUE - Agora vai para a listagem -->
                <a href="{{ route('estoques.index') }}" class="flex items-center space-x-3 p-3 hover:bg-blue-700 rounded-lg">
                    📦 <span>Estoque</span>
                </a>
                
                <!-- 👥 USUÁRIOS - Agora vai para a listagem -->
                <a href="{{ route('usuarios.index') }}" class="flex items-center space-x-3 p-3 hover:bg-blue-700 rounded-lg">
                    👥 <span>Usuários</span>
                </a>

                <!-- 🚪 LOGOUT - ADICIONE ESTA PARTE NO FINAL -->
                <div class="mt-8 pt-4 border-t border-blue-700">
                    <a href="{{ route('logout') }}" 
                       onclick="return confirm('Tem certeza que deseja sair?')"
                       class="flex items-center space-x-3 p-3 hover:bg-red-600 rounded-lg text-red-300 hover:text-white transition-colors">
                        🚪 <span>Sair do Sistema</span>
                    </a>
                </div>
                <!-- FIM DO LOGOUT -->
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1 p-6">
            <!-- Header -->
            <div class="flex justify-between items-center mb-8">
                <h1 class="text-3xl font-bold text-blue-800">Dashboard ModaExpress</h1>
                <div class="flex items-center space-x-4">
                    
                    <!-- 🔔 SISTEMA DE NOTIFICAÇÕES COMPLETO -->
                    <div class="relative" x-data="{ open: false }">
                        <!-- Botão do Sininho -->
                        <button @click="open = !open; $wire.carregarNotificacoes()" 
                                class="p-3 bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 hover:bg-blue-50 border border-blue-200 relative group">
                            <span class="text-2xl transition-transform duration-300 group-hover:scale-110">🔔</span>
                            
                            <!-- Badge de notificações não lidas -->
                            @if($notificacoesNaoLidas > 0)
                                <span class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full w-6 h-6 text-xs flex items-center justify-center animate-pulse shadow-lg">
                                    {{ $notificacoesNaoLidas }}
                                </span>
                            @endif
                        </button>

                        <!-- Dropdown de Notificações -->
                        <div x-show="open" 
                             x-cloak
                             @click.away="open = false"
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 transform scale-95 -translate-y-2"
                             x-transition:enter-end="opacity-100 transform scale-100 translate-y-0"
                             class="absolute right-0 mt-3 w-96 bg-white rounded-2xl shadow-2xl border border-blue-200 z-50 max-h-96 overflow-hidden">
                            
                            <!-- Cabeçalho -->
                            <div class="bg-gradient-to-r from-blue-600 to-cyan-600 p-4 text-white">
                                <div class="flex justify-between items-center">
                                    <div class="flex items-center gap-2">
                                        <span class="text-xl">🔔</span>
                                        <h3 class="font-bold text-lg">Notificações</h3>
                                        @if($notificacoesNaoLidas > 0)
                                            <span class="bg-white/20 px-2 py-1 rounded-full text-xs">
                                                {{ $notificacoesNaoLidas }} não lidas
                                            </span>
                                        @endif
                                    </div>
                                    @if($notificacoesNaoLidas > 0)
                                        <button wire:click="marcarTodasComoLidas" 
                                                class="text-xs bg-white/20 hover:bg-white/30 px-3 py-1 rounded-lg transition-colors flex items-center gap-1"
                                                title="Marcar todas como lidas">
                                            <span>✓</span>
                                            <span>Limpar</span>
                                        </button>
                                    @endif
                                </div>
                            </div>

                            <!-- Lista de Notificações -->
                            <div class="divide-y divide-blue-100 max-h-64 overflow-y-auto">
                                @forelse($notificacoes as $notificacao)
                                    <div class="p-4 hover:bg-blue-50 transition-colors cursor-pointer 
                                                {{ $notificacao->lida ? 'opacity-70' : 'bg-blue-25' }}"
                                         wire:click="marcarComoLida({{ $notificacao->id }})">
                                        <div class="flex gap-3">
                                            <!-- Ícone por tipo -->
                                            <div class="flex-shrink-0 w-10 h-10 rounded-full flex items-center justify-center 
                                                        {{ $notificacao->tipo == 'warning' ? 'bg-yellow-100 text-yellow-600 border border-yellow-200' : 
                                                           ($notificacao->tipo == 'danger' ? 'bg-red-100 text-red-600 border border-red-200' : 
                                                           ($notificacao->tipo == 'success' ? 'bg-green-100 text-green-600 border border-green-200' : 
                                                           'bg-blue-100 text-blue-600 border border-blue-200')) }}">
                                                @if($notificacao->tipo == 'warning') ⚠️
                                                @elseif($notificacao->tipo == 'danger') ❌
                                                @elseif($notificacao->tipo == 'success') ✅
                                                @else ℹ️
                                                @endif
                                            </div>

                                            <!-- Conteúdo -->
                                            <div class="flex-1 min-w-0">
                                                <p class="font-semibold text-blue-800 text-sm leading-tight">
                                                    {{ $notificacao->titulo }}
                                                </p>
                                                @if(!$notificacao->lida)
                                                    <p class="text-xs text-blue-600 mt-1 font-medium">
                                                        Nova
                                                    </p>
                                                @endif
                                                <p class="text-xs text-gray-500 mt-1">
                                                    {{ $notificacao->created_at->diffForHumans() }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                <!-- Adiciona uma mensagem se não houver notificações -->
                                @empty
                                    <div class="p-8 text-center text-gray-500">
                                        <span class="text-3xl block mb-2">🎉</span>
                                        <p class="font-semibold">Tudo limpo por aqui!</p>
                                        <p class="text-sm">Você não tem novas notificações.</p>
                                    </div>
                                @endforelse
                            </div>
                            
                            <!-- Rodapé (opcional) -->
                            <div class="p-4 border-t border-blue-100">
                                <a href="#" class="text-sm text-blue-600 hover:text-blue-800 transition-colors block text-center">
                                    Ver todas as notificações
                                </a>
                            </div>

                        </div>
                    </div>
                    <!-- FIM DO SISTEMA DE NOTIFICAÇÕES -->

                    <!-- User Profile Placeholder -->
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-blue-600 rounded-full"></div>
                        <span class="font-medium text-gray-700">Olá, Usuário</span>
                    </div>
                </div>
            </div>

            <!-- Page Content (Your main dashboard content goes here - added for completeness from original code) -->
            <div class="bg-white p-8 rounded-2xl shadow-xl">
                <h2 class="text-2xl font-semibold text-gray-800">Bem-vindo ao Dashboard</h2>
                <p class="mt-4 text-gray-600">
                    Aqui você pode gerenciar seus produtos, estoque e usuários de forma eficiente. O sistema já está todo em azul!
                </p>

                <!-- Exemplo de Card (from original code) -->
                <div class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="bg-blue-100 p-5 rounded-xl shadow-lg border border-blue-200">
                        <p class="text-blue-800 font-bold text-lg">Total de Produtos</p>
                        <p class="text-3xl font-extrabold text-blue-900 mt-1">1,250</p>
                    </div>
                    <div class="bg-green-100 p-5 rounded-xl shadow-lg border border-green-200">
                        <p class="text-green-800 font-bold text-lg">Estoque Disponível</p>
                        <p class="text-3xl font-extrabold text-green-900 mt-1">5,400 un</p>
                    </div>
                    <div class="bg-yellow-100 p-5 rounded-xl shadow-lg border border-yellow-200">
                        <p class="text-yellow-800 font-bold text-lg">Pedidos Pendentes</p>
                        <p class="text-3xl font-extrabold text-yellow-900 mt-1">45</p>
                    </div>
                </div>
            </div>
            
            <!-- Quick Access Buttons (from image context) -->
            <div class="mt-8 p-8 bg-white rounded-2xl shadow-xl">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Acesso Rápido</h2>
                <div class="flex space-x-4">
                     <a href="{{ route('produtos.index') }}" class="flex-1 p-4 bg-blue-600 text-white font-semibold rounded-lg text-center hover:bg-blue-700 transition-colors shadow-md">Ver Produtos</a>
                     <a href="{{ route('estoques.index') }}" class="flex-1 p-4 bg-green-600 text-white font-semibold rounded-lg text-center hover:bg-green-700 transition-colors shadow-md">Ver Estoque</a>
                     <a href="{{ route('usuarios.index') }}" class="flex-1 p-4 bg-blue-600 text-white font-semibold rounded-lg text-center hover:bg-blue-700 transition-colors shadow-md">Ver Usuários</a>
                </div>
            </div>

        </div>
    </div>
</div>
