<?php

namespace App\Livewire\Article;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CreateArticleForm extends Component
{
    // Proprietà tipizzate
    public string $title = '';
    public string $description = '';
    public string $price = '';
    public int $category_id = 0;
    public bool $success = false;

    // Regole di validazione in un metodo dedicato
    protected function rules(): array
    {
        return [
            'title'       => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'price'       => ['required', 'numeric', 'min:0'],
            'category_id' => ['required', 'integer', 'exists:categories,id'],
        ];
    }

    // Messaggi di errore in italiano
    protected function messages(): array
    {
        return [
            'title.required'       => 'Il titolo è obbligatorio.',
            'title.max'            => 'Il titolo non può superare 255 caratteri.',
            'description.required' => 'La descrizione è obbligatoria.',
            'price.required'       => 'Il prezzo è obbligatorio.',
            'price.numeric'        => 'Il prezzo deve essere un numero.',
            'price.min'            => 'Il prezzo non può essere negativo.',
            'category_id.required' => 'Seleziona una categoria.',
            'category_id.exists'   => 'La categoria selezionata non è valida.',
        ];
    }


    // store() è la convenzione Laravel per salvare una nuova risorsa
    public function store(): void
    {
        $this->validate();

        Article::create([
            'user_id'     => Auth::id(),
            'category_id' => $this->category_id,
            'title'       => $this->title,
            'description' => $this->description,
            'price'       => $this->price,
        ]);

        $this->reset(['title', 'description', 'price', 'category_id']);
        // Redirect to index before showing success message
        $this->redirectRoute('article.index');

        session()->flash('message', 'Annuncio inserito con successo!');
    }

    // Passa le categorie ordinate alla view
    public function render()
    {
        return view('livewire.article.create-article-form', [
            'categories' => Category::orderBy('name')->get(),
        ]);
    }
}
