@php
    $flags = [
        'it' => 'https://flagcdn.com/w40/it.png',
        'en' => 'https://flagcdn.com/w40/gb.png',
        'es' => 'https://flagcdn.com/w40/es.png',
    ];
    $current = app()->getLocale();
@endphp

<div class="lang-switcher">
    @foreach (config('app.available_locales') as $locale)
        <a href="{{ route('lang.switch', $locale) }}" class="lang-btn {{ $current === $locale ? 'active' : '' }}"
            title="{{ strtoupper($locale) }}">
            <img src="{{ $flags[$locale] }}" alt="{{ strtoupper($locale) }}" class="lang-flag">
        </a>
    @endforeach
</div>
