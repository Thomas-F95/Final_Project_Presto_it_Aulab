<x-layout>
    <x-slot:title>{{ __('cart.cart_cancel_title') }} — Presto</x-slot:title>

    <div class="row justify-content-center mt-5">
        <div class="col-12 col-md-6 text-center">
            <div class="auth-card">
                <div style="font-size: 3rem;">❌</div>
                <h2 class="auth-title mt-3">{{ __('cart.cart_cancel_title') }}</h2>
                <p class="auth-subtitle">{{ __('cart.cart_cancel_desc') }}</p>
                <a href="{{ route('cart.checkout') }}" class="btn-presto mt-3">
                    {{ __('messages.cart_back') }}
                </a>
            </div>
        </div>
    </div>

</x-layout>
