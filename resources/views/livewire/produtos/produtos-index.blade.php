<div class="min-h-screen bg-purple-50 p-6 font-sans">

    @if (session()->has('message'))
        <div class="mb-4 p-4 bg-purple-200 border-l-4 border-purple-600 text-purple-800 rounded shadow">
            {{ session('message') }}
        </div>
    @endif

    <div class="flex justify-between items-center mb-4">
        <input type="text" wire:model="search" placeholder="🔍 Pesquisar produto..."
               class="p-2 border border-purple-300 rounded w-1/2">
        <a href="{{ route('produtos.create') }}"
           class="bg-purple-500 hover:bg-purple-700 text-white py-2 px-4 rounded shadow">
           + Novo Produto
        </a>
    </div>

    <div class="overflow-x-auto bg-white rounded shadow">
        <table class="min-w-full divide-y divide-purple-200">
            <thead class="bg-purple-200 text-purple-800">
            <tr>
                <th class="px-4 py-2">Nome</th>
                <th class="px-4 py-2">Descrição</th>
                <th class="px-4 py-2">Preço</th>
                <th class="px-4 py-2">Qtd</th>
                <th class="px-4 py-2">Qtd Mín</th>
                <th class="px-4 py-2">Ações</th>
            </tr>
            </thead>
            <tbody class="divide-y divide-purple-100">
            @foreach($produtos as $produto)
                <tr class="hover:bg-purple-50">
                    <td class="px-4 py-2">{{ $produto->nome }}</td>
                    <td class="px-4 py-2">{{ $produto->descricao }}</td>
                    <td class="px-4 py-2">R$ {{ number_format($produto->preco, 2, ',', '.') }}</td>
                    <td class="px-4 py-2">{{ $produto->quantidade }}</td>
                    <td class="px-4 py-2">{{ $produto->quantidade_minima }}</td>
                    <td class="px-4 py-2 flex space-x-2">
                        <a href="{{ route('produtos.edit', $produto->id) }}"
                           class="bg-yellow-400 hover:bg-yellow-500 text-white px-2 py-1 rounded shadow text-sm">✏️</a>
                        <button wire:click="delete({{ $produto->id }})"
                                class="bg-red-500 hover:bg-red-600 text-white px-2 py-1 rounded shadow text-sm">🗑️</button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>

