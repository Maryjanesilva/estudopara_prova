<div class="min-h-screen bg-purple-50 p-6 font-sans">
    <!-- Sidebar Navigation -->
    <div class="flex">
        <!-- Sidebar -->
        <div class="bg-purple-800 text-white w-64 min-h-screen p-4">
            <div class="flex items-center space-x-3 mb-8 p-4 border-b border-purple-700">
                <div class="w-10 h-10 bg-purple-600 rounded-full flex items-center justify-center">
                    <span class="font-bold">ME</span>
                </div>
                <h1 class="text-xl font-bold">ModaExpress</h1>
            </div>
            
            <nav class="space-y-1">
                <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 p-3 bg-purple-700 rounded-lg">
                    📊 <span>Dashboard</span>
                </a>
                
                <!-- 🛍️ PRODUTOS - Agora vai para a listagem -->
                <a href="{{ route('produtos.index') }}" class="flex items-center space-x-3 p-3 hover:bg-purple-700 rounded-lg">
                    🛍️ <span>Produtos</span>
                </a>
                
                <!-- 📦 ESTOQUE - Agora vai para a listagem -->
                <a href="{{ route('estoques.index') }}" class="flex items-center space-x-3 p-3 hover:bg-purple-700 rounded-lg">
                    📦 <span>Estoque</span>
                </a>
                
                <!-- 👥 USUÁRIOS - Agora vai para a listagem -->
                <a href="{{ route('usuarios.index') }}" class="flex items-center space-x-3 p-3 hover:bg-purple-700 rounded-lg">
                    👥 <span>Usuários</span>
                </a>

                <!-- 🚪 LOGOUT - ADICIONE ESTA PARTE NO FINAL -->
                <div class="mt-8 pt-4 border-t border-purple-700">
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
                <h1 class="text-3xl font-bold text-purple-800">Dashboard ModaExpress</h1>
                <div class="flex items-center space-x-4">
                    
                    <!-- 🔔 SISTEMA DE NOTIFICAÇÕES COMPLETO -->
                    <div class="relative" x-data="{ open: false }">
                        <!-- Botão do Sininho -->
                        <button @click="open = !open; $wire.carregarNotificacoes()" 
                                class="p-3 bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 hover:bg-purple-50 border border-purple-200 relative group">
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
                             class="absolute right-0 mt-3 w-96 bg-white rounded-2xl shadow-2xl border border-purple-200 z-50 max-h-96 overflow-hidden">
                            
                            <!-- Cabeçalho -->
                            <div class="bg-gradient-to-r from-purple-600 to-pink-600 p-4 text-white">
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
                            <div class="divide-y divide-purple-100 max-h-64 overflow-y-auto">
                                @forelse($notificacoes as $notificacao)
                                    <div class="p-4 hover:bg-purple-50 transition-colors cursor-pointer 
                                                {{ $notificacao->lida ? 'opacity-70' : 'bg-purple-25' }}"
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
                                                <div class="flex justify-between items-start">
                                                    <p class="font-semibold text-purple-800 text-sm leading-tight">
                                                        {{ $notificacao->titulo }}
                                                    </p>
                                                    @if(!$notificacao->lida)
                                                        <span class="flex-shrink-0 w-2 h-2 bg-red-500 rounded-full ml-2 animate-pulse"></span>
                                                    @endif
                                                </div>
                                                <p class="text-gray-600 text-xs mt-1 leading-relaxed">
                                                    {{ $notificacao->mensagem }}
                                                </p>
                                                <p class="text-gray-400 text-xs mt-2">
                                                    {{ $notificacao->data_notificacao->format('d/m/Y H:i') }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <!-- Estado vazio -->
                                    <div class="p-8 text-center text-gray-500">
                                        <div class="text-5xl mb-3">🔔</div>
                                        <p class="font-medium text-gray-600">Nenhuma notificação</p>
                                        <p class="text-sm mt-1">Tudo sob controle! 🎉</p>
                                    </div>
                                @endforelse
                            </div>

                            <!-- Rodapé -->
                            <div class="bg-purple-50 p-3 border-t border-purple-200">
                                <div class="flex justify-between items-center text-sm">
                                    <span class="text-purple-600">
                                        Total: {{ $notificacoes->count() }} notificações
                                    </span>
                                    <button class="text-purple-600 hover:text-purple-800 font-medium transition-colors flex items-center gap-1">
                                        <span>Configurações</span>
                                        <span>⚙️</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- FIM DO SISTEMA DE NOTIFICAÇÕES -->

                    <div class="text-sm text-gray-600">
                        {{ now()->format('d/m/Y H:i') }}
                    </div>
                </div>
            </div>

            <!-- Cards de Estatísticas -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <!-- Total Produtos -->
                <div class="bg-white p-6 rounded-lg shadow border-l-4 border-purple-500 hover:shadow-md transition-shadow cursor-pointer">
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="text-gray-500 text-sm">Total Produtos</p>
                            <p class="text-2xl font-bold text-purple-700">{{ $totalProdutos }}</p>
                        </div>
                        <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center">
                            🛍️
                        </div>
                    </div>
                </div>

                <!-- Total Usuários -->
                <div class="bg-white p-6 rounded-lg shadow border-l-4 border-blue-500 hover:shadow-md transition-shadow cursor-pointer">
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="text-gray-500 text-sm">Total Usuários</p>
                            <p class="text-2xl font-bold text-blue-700">{{ $totalUsuarios }}</p>
                        </div>
                        <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                            👥
                        </div>
                    </div>
                </div>

                <!-- Estoque Baixo -->
                <div class="bg-white p-6 rounded-lg shadow border-l-4 border-orange-500 hover:shadow-md transition-shadow cursor-pointer">
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="text-gray-500 text-sm">Estoque Baixo</p>
                            <p class="text-2xl font-bold text-orange-700">{{ $estoqueBaixo }}</p>
                        </div>
                        <div class="w-12 h-12 bg-orange-100 rounded-full flex items-center justify-center">
                            ⚠️
                        </div>
                    </div>
                </div>

                <!-- Movimentações Hoje -->
                <div class="bg-white p-6 rounded-lg shadow border-l-4 border-green-500 hover:shadow-md transition-shadow cursor-pointer">
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="text-gray-500 text-sm">Mov. Hoje</p>
                            <p class="text-2xl font-bold text-green-700">{{ $movimentacoesHoje }}</p>
                        </div>
                        <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                            🔄
                        </div>
                    </div>
                </div>
            </div>

            <!-- Alertas de Estoque Baixo -->
            @if(count($alertas) > 0)
            <div class="bg-orange-50 border-l-4 border-orange-500 p-4 rounded-lg shadow mb-6">
                <h3 class="text-lg font-semibold text-orange-800 mb-2 flex items-center gap-2">
                    <span>⚠️</span>
                    Alertas de Estoque Baixo
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-2">
                    @foreach($alertas as $alerta)
                    <div class="bg-white p-3 rounded border border-orange-200">
                        <p class="font-medium text-orange-700">{{ $alerta->nome }}</p>
                        <p class="text-sm text-orange-600">Estoque: {{ $alerta->quantidade }} (mín: {{ $alerta->quantidade_minima }})</p>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- Quick Actions -->
            <div class="bg-white p-6 rounded-lg shadow mb-6">
                <h3 class="text-lg font-semibold text-purple-800 mb-4">Acesso Rápido</h3>
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <!-- 🛍️ Vai para LISTAGEM de produtos -->
                    <a href="{{ route('produtos.index') }}" class="bg-purple-600 hover:bg-purple-700 text-white py-3 px-4 rounded-lg text-center transition-colors">
                        🛍️ Ver Produtos
                    </a>
                    
                    <!-- 📦 Vai para LISTAGEM de estoque -->
                    <a href="{{ route('estoques.index') }}" class="bg-green-600 hover:bg-green-700 text-white py-3 px-4 rounded-lg text-center transition-colors">
                        📦 Ver Estoque
                    </a>
                    
                    <!-- 👥 Vai para LISTAGEM de usuários -->
                    <a href="{{ route('usuarios.index') }}" class="bg-blue-600 hover:bg-blue-700 text-white py-3 px-4 rounded-lg text-center transition-colors">
                        👥 Ver Usuários
                    </a>
                    
                    <!-- ➕ Vai para CRIAÇÃO -->
                    <a href="{{ route('produtos.create') }}" class="bg-orange-600 hover:bg-orange-700 text-white py-3 px-4 rounded-lg text-center transition-colors">
                        ➕ Novo Produto
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>