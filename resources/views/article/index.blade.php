<x-layout>
    <x-slot:title>Tutti gli annunci — Presto</x-slot:title>

     @if (session('message'))
        <div id="flash-message" class="alert-success-presto mb-4" role="alert">
            {{ session('message') }}
        </div>
    @endif
    
    <div class="row mb-4 mt-3">
        <div class="col">
            {{-- Mostra il nome della categoria se filtrata, altrimenti il titolo generico --}}
            <h1 class="welcome-title display-5">
                {{ isset($category) ? $category->name : 'Tutti gli annunci' }}
            </h1>
            {{-- Mostra la categoria attiva nel sottotitolo, altrimenti il testo generico --}}
            <p class="welcome-subtitle">
                {{ isset($category) ? 'Annunci nella categoria ' . $category->name : 'Scopri gli ultimi articoli in vendita' }}
            </p>
        </div>
    </div>

    <div class="row">

        {{-- Passa la categoria attiva al component --}}
        <x-category-sidebar :category="$category ?? null" />

        {{-- Griglia risultati --}}
        <div class="col">
            <div class="row gy-4">
                @forelse ($articles as $article)
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3 d-flex">
                        <x-card :article="$article" />
                    </div>
                @empty
                    <div class="col-12 text-center">
                        <p class="welcome-subtitle">Nessun annuncio in questa categoria.</p>
                        <a href="{{ route('article.index') }}" class="btn-presto mt-3">
                            Vedi tutti gli annunci
                        </a>
                    </div>
                @endforelse
            </div>

            @if ($articles->hasPages())
                <div class="d-flex justify-content-center mt-5">
                    {{ $articles->links() }}
                </div>
            @endif
        </div>

    </div>

</x-layout>
