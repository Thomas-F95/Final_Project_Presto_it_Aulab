<x-layout>
    <x-slot:title>Tutti gli annunci — Presto</x-slot:title>

    {{-- Header --}}
    <div class="row mb-5 mt-3">
        <div class="col-12 text-center">
            <h1 class="welcome-title display-5">Tutti gli annunci</h1>
            <p class="welcome-subtitle">Scopri gli ultimi articoli in vendita</p>
        </div>
    </div>

    {{-- Griglia articoli --}}
    <div class="row gy-4">
        @forelse ($articles as $article)
            <div class="col-12 col-sm-6 col-md-4 col-lg-3 d-flex">
                <x-card :article="$article" />
            </div>
        @empty
            <div class="col-12 text-center">
                <p class="welcome-subtitle">Non sono stati pubblicati annunci ancora.</p>
                @auth
                    <a href="{{ route('article.create') }}" class="btn-presto mt-3">
                        + Inserisci il primo annuncio
                    </a>
                @endauth
            </div>
        @endforelse
    </div>

    {{-- Paginazione --}}
    @if ($articles->hasPages())
        <div class="d-flex justify-content-center mt-5">
            {{ $articles->links() }}
        </div>
    @endif

</x-layout>
