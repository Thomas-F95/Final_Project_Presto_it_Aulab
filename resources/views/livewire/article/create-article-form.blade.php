<div>

    <form wire:submit="store">

        {{-- Titolo --}}
        <div class="mb-3">
            <label for="title" class="presto-label">Titolo</label>
            <input type="text" id="title" wire:model="title"
                class="presto-input @error('title') is-invalid @enderror" placeholder="Es. iPhone 13 — ottimo stato">
            @error('title')
                <div class="auth-error">{{ $message }}</div>
            @enderror
        </div>

        {{-- Categoria --}}
        <div class="mb-3">
            <label for="category_id" class="presto-label">Categoria</label>
            <select id="category_id" wire:model="category_id"
                class="presto-input @error('category_id') is-invalid @enderror">
                <option value="0">Seleziona una categoria</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
            @error('category_id')
                <div class="auth-error">{{ $message }}</div>
            @enderror
        </div>

        {{-- Prezzo --}}
        <div class="mb-3">
            <label for="price" class="presto-label">Prezzo (€)</label>
            <input type="number" id="price" wire:model="price"
                class="presto-input @error('price') is-invalid @enderror" placeholder="Es. 49.99" min="0"
                step="0.01">
            @error('price')
                <div class="auth-error">{{ $message }}</div>
            @enderror
        </div>

        {{-- Descrizione --}}
        <div class="mb-4">
            <label for="description" class="presto-label">Descrizione</label>
            <textarea id="description" wire:model="description" class="presto-input @error('description') is-invalid @enderror"
                rows="4" placeholder="Descrivi il tuo articolo..."></textarea>
            @error('description')
                <div class="auth-error">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn-presto w-100">
            Inserisci annuncio
        </button>

    </form>
</div>
