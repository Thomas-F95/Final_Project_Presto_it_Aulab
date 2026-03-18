<!doctype html>
<html lang="it-IT">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? '' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>

    <x-navbar />

    <main class="container mt-4">
        {{ $slot }}
    </main>

    
</body>

</html>
