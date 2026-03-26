@props(['category' => null])
<div class="col-12 col-md-3 col-lg-2">
    <div class="sidebar-categories">

        <button class="sidebar-toggle w-100 d-flex justify-content-between align-items-center" data-bs-toggle="collapse"
            data-bs-target="#sidebarLinks" aria-expanded="true" aria-controls="sidebarLinks">
            {{-- Titolo sidebar tradotto --}}
            <span class="sidebar-title">{{ __('messages.categories') }}</span>
            <span class="sidebar-arrow">▲</span>
        </button>

        <div class="collapse show mt-2" id="sidebarLinks">

            {{-- Link per rimuovere il filtro categoria --}}
            <a href="{{ route('article.index') }}" class="sidebar-link {{ !isset($category) ? 'active' : '' }}">
                {{ __('messages.all_articles_title') }}
            </a>

            {{-- Per ogni categoria mostra il nome tradotto nella lingua corrente --}}
            @foreach ($categories as $cat)
                <a href="{{ route('article.byCategory', $cat) }}"
                    class="sidebar-link {{ isset($category) && $category->id === $cat->id ? 'active' : '' }}">
                    {{ $cat->translated_name }}
                </a>
            @endforeach

        </div>

    </div>
</div>
