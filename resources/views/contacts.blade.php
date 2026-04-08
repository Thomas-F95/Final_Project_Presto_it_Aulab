<x-layout>
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8 text-center">
                <h1 class="display-4 mb-4">{{ __('messages.contacts_title') }}</h1>

                <p class="lead">{{ __('messages.contacts_description') }}</p>

                <div class="mt-5">
                    <a href="{{ route('homepage') }}" class="btn-presto-outline btn-sm">{{ __('messages.back_home') }}</a>
                </div>
            </div>


        </div>
    </div>
</x-layout>
