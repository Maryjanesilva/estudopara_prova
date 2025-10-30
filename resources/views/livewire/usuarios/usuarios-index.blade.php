<div class="min-h-screen bg-purple-50 p-6 font-sans">

    @if (session()->has('message'))
        <div class="mb-4 p-4 bg-purple-200 border-l-4 border-purple-600 text-purple-800 rounded shadow">
            {{ session('message') }}
        </div>
    @endif

    <div class="flex justify-between items-center mb-4">
        <div class="flex items-center bg-white rounded shadow px-3 py-2 w-1/2">
            <input type="text" wire:model="search" placeholder="🔍 Pesquisar usuário..."
                   class="w-full outline-none px-2 py-1 rounded text-purple-700">
        </div>
        <a href="{{ route('usuarios.create') }}"
           class="bg-purple-500 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded shadow">
           + Novo Usuário
        </a>
    </div>

    <div class="overflow-x-auto bg-white rounded shadow">
        <table class="min-w-full divide-y divide-purple-200">
            <thead class="bg-purple-200 text-purple-800">
            <tr>
                <th class="px-4 py-2 text-left">Nome</th>
                <th class="px-4 py-2 text-left">Email</th>
                <th class="px-4 py-2 text-left">Ações</th>
            </tr>
            </thead>
            <tbody class="divide-y divide-purple-100">
            @foreach($usuarios as $usuario)
                <tr class="hover:bg-purple-50">
                    <td class="px-4 py-2">{{ $usuario->nome }}</td>
                    <td class="px-4 py-2">{{ $usuario->email }}</td>
                    <td class="px-4 py-2 flex space-x-2">
                        <a href="{{ route('usuarios.edit', $usuario->id) }}"
                           class="bg-yellow-400 hover:bg-yellow-500 text-white px-2 py-1 rounded shadow text-sm">
                           ✏️
                        </a>
                        <button wire:click="delete({{ $usuario->id }})"
                                class="bg-red-500 hover:bg-red-600 text-white px-2 py-1 rounded shadow text-sm">
                            🗑️
                        </button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>

