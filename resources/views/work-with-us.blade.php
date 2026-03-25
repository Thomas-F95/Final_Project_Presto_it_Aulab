<x-layout>
    <x-slot:title>Lavora con noi — Presto</x-slot:title>

    <div class="row justify-content-center mt-5">
        <div class="col-12 col-md-8 col-lg-6">

            <h1 class="auth-title mb-1">Lavora con noi</h1>
            <p class="auth-subtitle">
                Diventa revisore della community Presto e aiutaci a mantenere il portale sicuro e affidabile.
            </p>

            @if (session('success'))
                <div id="flash-message" class="alert-success-presto mb-4">{{ session('success') }}</div>
            @endif

            @auth
                <div class="auth-card">
                    <form method="POST" action="{{ route('work-with-us.send') }}">
                        @csrf

                        {{-- Nome — precompilato e readonly --}}
                        <div class="mb-3">
                            <label class="presto-label">Nome</label>
                            <input type="text" class="presto-input" value="{{ auth()->user()->name }}" readonly>
                        </div>

                        {{-- Email — precompilata e readonly --}}
                        <div class="mb-3">
                            <label class="presto-label">Email</label>
                            <input type="email" class="presto-input" value="{{ auth()->user()->email }}" readonly>
                        </div>

                        {{-- Motivazione --}}
                        <div class="mb-4">
                            <label for="motivation" class="presto-label">
                                Perché vuoi diventare revisore?
                            </label>
                            <textarea id="motivation" name="motivation" class="presto-input @error('motivation') is-invalid @enderror"
                                rows="5" placeholder="Raccontaci la tua motivazione...">{{ old('motivation') }}</textarea>
                            @error('motivation')
                                <div class="auth-error">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn-presto w-100">
                            Invia candidatura
                        </button>
                    </form>
                </div>
            @endauth

            @guest
                <div class="auth-card text-center">
                    <p class="welcome-subtitle mb-4">
                        Devi essere registrato per candidarti come revisore.
                    </p>
                    <div class="d-flex gap-3 justify-content-center">
                        <a href="{{ route('register') }}" class="btn-presto">Registrati</a>
                        <a href="{{ route('login') }}" class="btn-presto-outline">Accedi</a>
                    </div>
                </div>
            @endguest

        </div>
    </div>

</x-layout>
