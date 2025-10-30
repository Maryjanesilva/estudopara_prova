<div class="min-h-screen bg-purple-50 p-6 font-sans">

    <h2 class="text-purple-700 font-bold text-xl mb-4">Cadastrar Usuário</h2>

    @if (session()->has('message'))
        <div class="mb-4 p-4 bg-purple-200 border-l-4 border-purple-600 text-purple-800 rounded shadow">
            {{ session('message') }}
        </div>
    @endif

    <div class="bg-white p-6 rounded shadow mb-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <input type="text" wire:model="nome" placeholder="Nome do Usuário"
                   class="p-2 border border-purple-300 rounded w-full">
            <input type="email" wire:model="email" placeholder="Email"
                   class="p-2 border border-purple-300 rounded w-full">
            <input type="password" wire:model="senha" placeholder="Senha"
                   class="p-2 border border-purple-300 rounded w-full">
        </div>
        <div class="mt-4 flex space-x-2">
            <button wire:click="store"
                    class="bg-purple-600 hover:bg-purple-800 text-white py-2 px-4 rounded shadow">
                Cadastrar
            </button>
            <a href="{{ route('usuarios.index') }}"
               class="bg-gray-300 hover:bg-gray-400 text-gray-800 py-2 px-4 rounded shadow">
                Voltar
            </a>
        </div>
    </div>
</div>

