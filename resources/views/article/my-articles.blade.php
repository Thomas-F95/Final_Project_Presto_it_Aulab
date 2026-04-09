<x-layout>
    <x-slot:title>{{ __('messages.my_articles') }} — Presto</x-slot:title>

    <div class="row mb-4 mt-3">
        <div class="col">
            <h1 class="welcome-title display-5">{{ __('messages.my_articles') }}</h1>
            <p class="welcome-subtitle">{{ __('messages.my_articles_desc') }}</p>
        </div>
    </div>

    <div class="row">
        {{-- Colonna fittizia della stessa larghezza della sidebar --}}
        <div class="col-12 col-md-3 col-xl-2"></div>

        {{-- Griglia articoli --}}
        <div class="col-12 col-md-9 col-xl-10">
            <div class="row gy-4 align-items-stretch">
                @forelse ($articles as $article)
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3 d-flex flex-column">
                        <x-card :article="$article" :showStatus="true" />
                        <div class="d-flex gap-2 mt-2">
                            <a href="{{ route('article.edit', $article) }}" class="btn-presto-outline btn-sm w-100">
                                {{ __('messages.article_edit') }}
                            </a>
                            <form method="POST" action="{{ route('article.destroy', $article) }}" class="w-100"
                                onsubmit="return confirm('{{ __('messages.article_delete_confirm') }}')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-danger-presto btn-sm w-100">
                                    {{ __('messages.article_delete') }}
                                </button>
                            </form>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center">
                        <p class="welcome-subtitle">{{ __('messages.no_articles') }}</p>
                        <a href="{{ route('article.create') }}" class="btn-presto mt-3">
                            {{ __('messages.insert_first') }}
                        </a>
                    </div>
                @endforelse
            </div>

            @if ($articles->hasPages())
                <div class="d-flex justify-content-center mt-5">
                    {{ $articles->links() }}
                </div>
            @endif
        </div>
    </div>

</x-layout>
