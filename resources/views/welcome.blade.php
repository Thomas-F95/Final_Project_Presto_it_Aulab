<x-layout>
    <x-slot:title>Home — Presto.it</x-slot:title>

    {{-- Hero --}}
    <div class="row justify-content-center mt-5">
        <div class="col-12 col-md-8 text-center">
            <h1 class="display-4 fw-bold welcome-title">Presto.it</h1>
            <p class="lead mb-4 welcome-subtitle">
                Il portale numero uno per vendere e comprare articoli di ogni tipo.
            </p>
            <div class="d-flex gap-3 justify-content-center">
                {{-- Attivare quando esiste la rotta article.index (US2) --}}
                <a href="{{ route('article.index') }}" class="btn-presto btn-lg">Vedi annunci</a>
                @guest
                    <a href="{{ route('register') }}" class="btn-presto-outline btn-lg">Registrati gratis</a>
                @endguest
                @auth
                    <a href="{{ route('article.create') }}" class="btn-presto-outline btn-lg">+ Inserisci annuncio</a>
                @endauth
            </div>
        </div>
    </div>

    {{-- Ultimi annunci: attivare nella US2 --}}
    {{--
    <div class="row justify-content-center mt-5">
        @forelse ($articles as $article)
            <div class="col-12 col-md-3">
                <x-card :article="$article" />
            </div>
        @empty
            <div class="col-12">
                <h3 class="text-center">Non sono stati creati articoli</h3>
            </div>
        @endforelse
    </div>
    --}}

</x-layout>
