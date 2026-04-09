<?php

namespace App\Livewire\Article;

use App\Models\Article;
use App\Models\Category;
use App\Models\Image;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Jobs\ResizeImage;
use App\Jobs\GoogleVisionLabelImage;
use App\Jobs\GoogleVisionSafeSearch;
use App\Jobs\RemoveFaces;
use Illuminate\Support\Facades\Bus;

class EditArticleForm extends Component
{
    use WithFileUploads;

    public Article $article;

    public string $title = '';
    public string $description = '';
    public string $price = '';
    public int $category_id = 0;

    // Immagini esistenti già salvate nel DB
    public array $existingImages = [];

    // Nuove immagini caricate temporaneamente
    public array $images = [];
    public $temporary_images = [];

    public function mount(Article $article): void
    {
        // Verifica che l'utente loggato sia il proprietario
        if ($article->user_id !== Auth::id()) {
            abort(403);
        }

        $this->article = $article;
        $this->title = $article->title;
        $this->description = $article->description;
        $this->price = $article->price;
        $this->category_id = $article->category_id;

        // Carica le immagini esistenti
        $this->existingImages = $article->images->map(fn($img) => [
            'id'   => $img->id,
            'path' => $img->path,
        ])->toArray();
    }

    protected function rules(): array
    {
        return [
            'title'       => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'price'       => ['required', 'numeric', 'min:0'],
            'category_id' => ['required', 'integer', 'exists:categories,id'],
            'images.*'    => ['image', 'max:2048'],
        ];
    }

    protected function messages(): array
    {
        return [
            'title.required'       => __('messages.title_required'),
            'title.max'            => __('messages.title_max'),
            'description.required' => __('messages.description_required'),
            'price.required'       => __('messages.price_required_numeric'),
            'price.numeric'        => __('messages.price_numeric'),
            'price.min'            => __('messages.price_min'),
            'category_id.required' => __('messages.category_id_required'),
            'category_id.exists'   => __('messages.category_id_exists'),
            'images.*.image'       => __('messages.images_*_image'),
            'images.*.max'         => __('messages.images_*_max'),
        ];
    }

    // Unisce le nuove foto a quelle temporanee
    public function updatedTemporaryImages(): void
    {
        $this->validate([
            'temporary_images.*' => 'image|max:2048|mimes:jpeg,png,jpg,webp',
        ]);

        foreach ($this->temporary_images as $image) {
            $this->images[] = $image;
        }
    }

    // Rimuove una nuova immagine dall'array temporaneo
    public function removeImage(int $index): void
    {
        array_splice($this->images, $index, 1);
    }

    // Rimuove un'immagine esistente dal DB e dallo storage
    public function removeExistingImage(int $imageId): void
    {
        $image = Image::find($imageId);

        if ($image && $image->article->user_id === Auth::id()) {
            Storage::disk('public')->delete($image->path);
            $image->delete();
        }

        // Aggiorna l'array delle immagini esistenti
        $this->existingImages = array_filter(
            $this->existingImages,
            fn($img) => $img['id'] !== $imageId
        );
    }

    public function update(): void
    {
        $this->validate();

        // Rimette l'articolo in pending dopo la modifica — deve essere ri-approvato
        $this->article->update([
            'category_id' => $this->category_id,
            'title'       => $this->title,
            'description' => $this->description,
            'price'       => $this->price,
            'status'      => 'pending',
        ]);

        // Salva le nuove immagini e lancia i job
        foreach ($this->images as $image) {
            $path = $image->store('articles', 'public');

            $imageModel = Image::create([
                'article_id' => $this->article->id,
                'path'       => $path,
            ]);

            Bus::chain([
                new GoogleVisionSafeSearch($imageModel),
                new GoogleVisionLabelImage($imageModel),
                new RemoveFaces($imageModel),
                new ResizeImage($imageModel),
            ])->dispatch();
        }

        $this->redirectRoute('article.my');
    }

    public function render(): \Illuminate\View\View
    {
        return view('livewire.article.edit-article-form', [
            'categories' => Category::orderBy('name')->get(),
        ]);
    }
}
