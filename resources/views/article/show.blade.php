{{-- Carosello immagini -- reali se presenti, segnaposto altrimenti --}}
<div class="article-carousel mb-4">
    @if ($article->images->count() > 0)
        @foreach ($article->images as $i => $image)
            <img src="{{ asset('storage/' . $image->path) }}" alt="Immagine {{ $i + 1 }} di {{ $article->title }}"
                class="article-carousel-img {{ $i === 0 ? 'active' : '' }}">
        @endforeach
    @else
        {{-- Segnaposto se non ci sono immagini --}}
        <img src="https://picsum.photos/seed/{{ $article->id }}/800/400" alt="{{ $article->title }}"
            class="article-carousel-img active">
    @endif
    <button class="carousel-btn carousel-btn-prev" onclick="changeSlide(-1)">‹</button>
    <button class="carousel-btn carousel-btn-next" onclick="changeSlide(1)">›</button>

    @auth
        @if ($article->user_id !== auth()->id())
            <form method="POST" action="{{ route('cart.add', $article) }}" class="mt-3">
                @csrf
                <button type="submit" class="btn-presto">
                    {{ __('messages.cart_add') }}
                </button>
            </form>
        @endif
    @endauth
    @guest
        <a href="{{ route('login') }}" class="btn-presto-outline mt-3 d-inline-block">
            {{ __('messages.login') }} {{ __('messages.cart_add') }}
        </a>
    @endguest
</div>
