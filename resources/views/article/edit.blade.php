<x-layout>
    <x-slot:title>{{ __('messages.article_edit') }} — Presto</x-slot:title>

    <div class="row justify-content-center mt-4">
        <div class="col-12 col-lg-7">
            <h1 class="auth-title mb-1">{{ __('messages.article_edit') }}</h1>
            <p class="auth-subtitle mb-4">{{ __('messages.article_edit_subtitle') }}</p>

            @livewire('article.edit-article-form', ['article' => $article])
        </div>
    </div>
</x-layout>
