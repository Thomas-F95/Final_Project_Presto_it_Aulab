<x-layout>
    <x-slot:title>Home — Presto.it</x-slot:title>

    <div class="row justify-content-center mt-5">
        <div class="col-12 col-md-8 text-center">
            <h1 class="display-4 fw-bold welcome-title">Presto.it</h1>
            <p class="lead mb-4 welcome-subtitle">
                Il portale numero uno per vendere e comprare articoli di ogni tipo.
            </p>
            <div class="d-flex gap-3 justify-content-center">
                {{-- Attivare quando esiste la rotta article.index (US2) --}}
                <a href="#" class="btn-presto btn-lg">Vedi annunci</a>
                @guest
                    <a href="{{ route('register') }}" class="btn-presto-outline btn-lg">Registrati gratis</a>
                @endguest
                @auth
                    {{-- Attivare quando esiste la rotta article.create (US1) --}}
                    <a href="#" class="btn-presto-outline btn-lg">+ Inserisci annuncio</a>
                @endauth
            </div>
            <div class="row height-custom justify-content-center align-items-center py-5"></div>
            @foreles ($articles as $articel)
            <div class="col-12 col-md-3">
                <x-card :article="$articel" />
            </div>
            @empty
                <div class="col-12">
                    <h3 class="text-center">Non sono stati creati articoli</h3>
                </div>
                @endforeles

            </div>
        </div>

    </x-layout>


    <p> Thomas </p>
