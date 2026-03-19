<x-layout>

<div class="card mx-auto card-w shadow text-center mb-3"></div>
<img src="https://picsum.photo/200" alt="immagine dell'articolo{{ $article->title }}" class="card-img-top">

 <div class="card-body">
    <h5 class="card-title">{{ $article->title }}</h5>
    <h6 class="card-subtitle text-body-secondary">{{ $article->price }}</h6>
    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card’s content.</p>
  </div>
  <div class="card-body">
    <a href="#" class="card-link">Dettaglio</a>
    <a href="#" class="card-link">Categoria</a>
  </div>
</div>


</x-layout>