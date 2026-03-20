<div class="article-card">

    <img src="https://picsum.photos/seed/{{ $article->id }}/400/180" alt="Immagine di {{ $article->title }}"
        class="article-card-img">

    <div class="article-card-body">
        <div class="article-card-category">{{ $article->category->name }}</div>
        <h5 class="article-card-title">{{ $article->title }}</h5>
        <p class="article-card-price">€ {{ number_format($article->price, 2, ',', '.') }}</p>

        <div class="article-card-footer">
            {{-- Attivare quando esiste la rotta article.show (US2) --}}
            <a href="#" class="article-card-link">Dettaglio →</a>
            {{-- Attivare quando esiste il filtro categoria (US2) --}}
            <a href="#" class="article-card-link">{{ $article->category->name }}</a>
        </div>
    </div>

</div>
