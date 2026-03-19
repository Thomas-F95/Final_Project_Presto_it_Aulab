<x-layout>
    <x-slot:title>Registrati — Presto</x-slot:title>

    <div class="row justify-content-center mt-5">
        <div class="col-12 col-sm-9 col-md-6 col-lg-5">

            <div class="auth-card">

                <h1 class="auth-title">Crea un account</h1>
                <p class="auth-subtitle">Unisciti a Presto e inizia a vendere</p>

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    {{-- Nome --}}
                    <div class="mb-3">
                        <label for="name" class="presto-label">Nome completo</label>
                        <input type="text" id="name" name="name"
                            class="presto-input @error('name') is-invalid @enderror" value="{{ old('name') }}"
                            required autofocus autocomplete="name" placeholder="Mario Rossi">
                        @error('name')
                            <div class="auth-error">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Email --}}
                    <div class="mb-3">
                        <label for="email" class="presto-label">Email</label>
                        <input type="email" id="email" name="email"
                            class="presto-input @error('email') is-invalid @enderror" value="{{ old('email') }}"
                            required autocomplete="email" placeholder="nome@esempio.it">
                        @error('email')
                            <div class="auth-error">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Password --}}
                    <div class="mb-3">
                        <label for="password" class="presto-label">Password</label>
                        <input type="password" id="password" name="password"
                            class="presto-input @error('password') is-invalid @enderror" required
                            autocomplete="new-password" placeholder="••••••••">
                        @error('password')
                            <div class="auth-error">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Conferma password --}}
                    <div class="mb-4">
                        <label for="password_confirmation" class="presto-label">Conferma password</label>
                        <input type="password" id="password_confirmation" name="password_confirmation"
                            class="presto-input" required autocomplete="new-password" placeholder="••••••••">
                    </div>

                    <button type="submit" class="btn-presto w-100">Crea account</button>

                </form>

                <hr class="auth-divider my-4">

                <p class="text-center small mb-0 auth-subtitle">
                    Hai già un account?
                    <a href="{{ route('login') }}" class="auth-link">Accedi</a>
                </p>

            </div>
        </div>
    </div>

</x-layout>
