<x-layout>
    <x-slot:title>{{ $article->title }} — Presto</x-slot:title>

    <div class="row justify-content-center mt-4">
        <div class="col-12 col-lg-8">

            {{-- Breadcrumb con categoria tradotta --}}
            <nav class="mb-4">
                <ol class="breadcrumb-presto">
                    <li>
                        <a href="{{ route('article.index') }}" class="auth-link">{{ __('messages.articles') }}</a>
                    </li>
                    <li class="breadcrumb-separator">›</li>
                    <li>
                        <a href="{{ route('article.byCategory', $article->category) }}" class="auth-link">
                            {{ $article->category->translated_name }}
                        </a>
                    </li>
                    <li class="breadcrumb-separator">›</li>
                    <li class="breadcrumb-current">{{ $article->title }}</li>
                </ol>
            </nav>

            {{-- Carosello immagini segnaposto -- verra sostituito con immagini reali nella US5 --}}
            <div class="article-carousel mb-4">
                @for ($i = 1; $i <= 3; $i++)
                    <img src="https://picsum.photos/seed/{{ $article->id }}{{ $i }}/800/400"
                        alt="Immagine {{ $i }} di {{ $article->title }}"
                        class="article-carousel-img {{ $i === 1 ? 'active' : '' }}">
                @endfor
                <button class="carousel-btn carousel-btn-prev" onclick="changeSlide(-1)">‹</button>
                <button class="carousel-btn carousel-btn-next" onclick="changeSlide(1)">›</button>
            </div>

            {{-- Dettaglio annuncio --}}
            <div class="article-show-card">

                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div>
                        {{-- Categoria tradotta nella lingua corrente --}}
                        <span class="article-card-category">{{ $article->category->translated_name }}</span>
                        <h1 class="article-show-title">{{ $article->title }}</h1>
                    </div>
                    <span class="article-show-price">€ {{ number_format($article->price, 2, ',', '.') }}</span>
                </div>

                <hr class="auth-divider my-3">

                <p class="article-show-description">{{ $article->description }}</p>

                <hr class="auth-divider my-3">

                <div class="d-flex justify-content-between align-items-center">
                    {{-- Meta informazioni -- venditore e data --}}
                    <span class="article-show-meta">
                        {{ __('messages.sold_by') }} <strong>{{ $article->user->name }}</strong>
                    </span>
                    <span class="article-show-meta">
                        {{ $article->created_at->diffForHumans() }}
                    </span>
                </div>

            </div>

        </div>
    </div>

</x-layout>
