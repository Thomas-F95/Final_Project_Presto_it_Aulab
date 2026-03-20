<div class="article-card">

    <img src="https://picsum.photos/seed/{{ $article->id }}/400/180" alt="Immagine di {{ $article->title }}"
        class="article-card-img">

    <div class="p-3">
        <div class="article-card-category mb-1">{{ $article->category->name }}</div>
        <h5 class="article-card-title">{{ $article->title }}</h5>
        <p class="article-card-price mb-3">€ {{ number_format($article->price, 2, ',', '.') }}</p>
        <div class="d-flex gap-3">
            {{-- Attivare quando esiste la rotta article.show (US2) --}}
            <a href="#" class="article-card-link">Dettaglio →</a>
            {{-- Attivare quando esiste la rotta article.index con filtro categoria (US2) --}}
            <a href="#" class="article-card-link">{{ $article->category->name }}</a>
        </div>
    </div>

</div>
