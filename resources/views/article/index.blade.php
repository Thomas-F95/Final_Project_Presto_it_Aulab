<x-layout>


    <div class="container-fluid">
        <div class="row height-custom justify-content-center align-items-center text-center ">
            <div class="col-12">
                <h1 class="display-1">Tutti gli articoli</h1>
            </div>
        </div>

        <div class="row height-custom justify-content-center align-items-center py-5 ">
           
            @forelse ($articles as $articel)
            <div class="col-12 col-md-3">
                <x-card :article="$articel" />
            </div>
            @empty
                <div class="col-12">
                    <h3 class="text-center">Non sono stati creati articoli</h3>
                </div>
                @endforeles
            </div>

            <div class="d-flex justify-content-center">
              {{--  Il metodo $articles->links(), genera un insieme di link HTML per navigare tra diverse pagine dei risultati paginati--}}
                <div>{{ $article->links() }}</div>
            
            </div>
        </div>

    </x-layout>
