<x-layout>
    <x-slot:title>Pannello Revisori — Presto</x-slot:title>

    <div class="row justify-content-center mt-4">
        <div class="col-12 col-lg-8">

            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h1 class="auth-title mb-1">Pannello Revisori</h1>
                    <p class="auth-subtitle mb-0">Revisiona gli annunci in attesa di approvazione</p>
                </div>

                {{-- EXTRA: bottone undo --}}
                @if (session('last_action'))
                    <form method="POST" action="{{ route('revisor.undo') }}">
                        @csrf
                        <button type="submit" class="btn-presto-outline btn-sm">
                            Annulla ultima operazione
                        </button>
                    </form>
                @endif
            </div>

            {{-- Feedback --}}
            @if (session('success'))
                <div class="alert-success-presto mb-4">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="alert-error-presto mb-4">{{ session('error') }}</div>
            @endif

            @if ($article)
                <div class="revisor-card">

                    {{-- Header --}}
                    <div class="revisor-card-header">
                        <span class="article-card-category">{{ $article->category->name }}</span>
                        <span class="revisor-meta">Inviato da {{ $article->user->name }} ·
                            {{ $article->created_at->diffForHumans() }}</span>
                    </div>

                    {{-- Contenuto --}}
                    <h2 class="revisor-title">{{ $article->title }}</h2>
                    <p class="article-card-price">€ {{ number_format($article->price, 2, ',', '.') }}</p>
                    <p class="article-show-description">{{ $article->description }}</p>

                    {{-- Azioni --}}
                    <div class="revisor-actions">
                        <form method="POST" action="{{ route('revisor.approve', $article) }}">
                            @csrf
                            <button type="submit" class="btn-revisor-approve">
                                Approva
                            </button>
                        </form>
                        <form method="POST" action="{{ route('revisor.reject', $article) }}">
                            @csrf
                            <button type="submit" class="btn-revisor-reject">
                                Rifiuta
                            </button>
                        </form>
                    </div>

                </div>
            @else
                {{-- Nessun annuncio in attesa --}}
                <div class="revisor-empty">
                    <p class="welcome-subtitle">Nessun annuncio in attesa di revisione.</p>
                    <a href="{{ route('homepage') }}" class="btn-presto mt-3">Torna alla home</a>
                </div>
            @endif

        </div>
    </div>

</x-layout>
