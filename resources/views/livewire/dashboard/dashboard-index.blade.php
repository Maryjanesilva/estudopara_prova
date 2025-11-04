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
            <!-- Header e Cards (mantenha igual) -->
            <div class="flex justify-between items-center mb-8">
                <h1 class="text-3xl font-bold text-purple-800">Dashboard ModaExpress</h1>
                <div class="flex items-center space-x-4">
                    <div class="relative">
                        <button class="p-2 bg-white rounded-full shadow hover:bg-purple-50">
                            🔔
                        </button>
                        @if(count($alertas) > 0)
                        <span class="absolute -top-1 -right-1 bg-red-500 text-white rounded-full w-5 h-5 text-xs flex items-center justify-center">
                            {{ count($alertas) }}
                        </span>
                        @endif
                    </div>
                    <div class="text-sm text-gray-600">
                        {{ now()->format('d/m/Y H:i') }}
                    </div>
                </div>
            </div>

            <!-- ... (mantenha os cards de estatísticas) ... -->

            <!-- Quick Actions ATUALIZADAS -->
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