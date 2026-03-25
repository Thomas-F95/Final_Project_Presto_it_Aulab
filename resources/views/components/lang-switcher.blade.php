@php
    $flags = [
        'it' => '🇮🇹',
        'en' => '🇬🇧',
        'es' => '🇪🇸',
    ];
    $current = app()->getLocale();
@endphp

<div class="lang-switcher">
    @foreach (config('app.available_locales') as $locale)
        href="{{ route('lang.switch', $locale) }}"
        class="lang-btn {{ $current === $locale ? 'active' : '' }}"
        title="{{ strtoupper($locale) }}"
        >
        {{ $flags[$locale] }}
        </a>
    @endforeach
</div>
