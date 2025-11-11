<div class="min-h-screen bg-blue-50 p-6 font-sans">

    <h2 class="text-blue-700 font-bold text-xl mb-4">Editar Usuário</h2>

    @if (session()->has('message'))
        <div class="mb-4 p-4 bg-blue-200 border-l-4 border-blue-600 text-blue-800 rounded shadow">
            {{ session('message') }}
        </div>
    @endif

    <div class="bg-white p-6 rounded shadow mb-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <input type="text" wire:model="nome" placeholder="Nome do Usuário"
                   class="p-2 border border-blue-300 rounded w-full">
            <input type="email" wire:model="email" placeholder="Email"
                   class="p-2 border border-blue-300 rounded w-full">
            <input type="password" wire:model="senha" placeholder="Senha (se quiser alterar)"
                   class="p-2 border border-blue-300 rounded w-full">
        </div>
        <div class="mt-4 flex space-x-2">
            <button wire:click="update"
                    class="bg-blue-600 hover:bg-blue-800 text-white py-2 px-4 rounded shadow">
                Atualizar
            </button>
            <a href="{{ route('usuarios.index') }}"
               class="bg-gray-300 hover:bg-gray-400 text-gray-800 py-2 px-4 rounded shadow">
                Voltar
            </a>
        </div>
    </div>
</div>
