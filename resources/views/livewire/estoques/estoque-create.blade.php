<div class="container mt-5">
    <h2 class="mb-4 text-center">🆕 Adicionar Estoque</h2>

    <div class="card shadow-sm p-4">
        <form wire:submit.prevent="salvar">
            <div class="mb-3">
                <label for="produto_id" class="form-label">Produto</label>
                <select wire:model="produto_id" id="produto_id" class="form-select">
                    <option value="">Selecione um produto</option>
                    @foreach ($produtos as $produto)
                        <option value="{{ $produto->id }}">{{ $produto->nome }}</option>
                    @endforeach
                </select>
                @error('produto_id') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="mb-3">
                <label for="quantidade" class="form-label">Quantidade</label>
                <input type="number" wire:model="quantidade" id="quantidade" class="form-control">
                @error('quantidade') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="mb-3">
                <label for="localizacao" class="form-label">Localização (opcional)</label>
                <input type="text" wire:model="localizacao" id="localizacao" class="form-control">
                @error('localizacao') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <button type="submit" class="btn btn-success">Salvar</button>
            <a href="{{ route('estoques.index') }}" class="btn btn-secondary ms-2">Voltar</a>
        </form>
    </div>

    @if (session('success'))
        <div class="alert alert-success mt-3 text-center">
            {{ session('success') }}
        </div>
    @endif
</div>

