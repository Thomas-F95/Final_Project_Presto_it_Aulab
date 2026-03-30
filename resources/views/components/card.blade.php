<div class="article-card">

    {{-- Mostra la prima immagine reale se disponibile, altrimenti usa picsum --}}
    <img src="{{ $article->images->first() ? asset('storage/' . $article->images->first()->path) : 'https://picsum.photos/seed/' . $article->id . '/220/220' }}"
        alt="Immagine di {{ $article->title }}" class="article-card-img">

    <div class="article-card-body">
        <div class="article-card-category">{{ $article->category->translated_name }}</div>
        <h5 class="article-card-title">{{ $article->title }}</h5>

        {{-- Prezzo e bottone carrello sulla stessa riga --}}
        <div class="d-flex justify-content-between align-items-center mb-3">
            <p class="article-card-price mb-0">€ {{ number_format($article->price, 2, ',', '.') }}</p>
            @auth
                @if ($article->user_id !== auth()->id())
                    <form method="POST" action="{{ route('cart.add', $article) }}">
                        @csrf
                        <button type="submit" class="cart-card-btn" title="{{ __('messages.cart_add') }}">
                            🛒
                        </button>
                    </form>
                @endif
            @endauth
        </div>

        <div class="article-card-footer">
            <a href="{{ route('article.show', $article) }}" class="article-card-link">{{ __('messages.detail') }}</a>
            <a href="{{ route('article.byCategory', $article->category) }}"
                class="article-card-link">{{ $article->category->translated_name }}</a>
        </div>
    </div>

</div>
