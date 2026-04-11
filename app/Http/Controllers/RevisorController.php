<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class RevisorController extends Controller
{
    // Lista annunci da revisionare — uno alla volta dal meno recente, escludi quelli del revisore loggato
    public function index()
    {
        $article = Article::with(['category', 'user'])
            ->pending()
            ->where('user_id', '!=', Auth::id())
            ->orderBy('created_at', 'asc')
            ->first();

        return view('revisor.index', compact('article'));
    }

    // Approva annuncio
    public function approve(Article $article)
    {
        // Sicurezza: il revisore non può approvare i propri articoli
        if ($article->user_id === Auth::id()) {
            return redirect()->route('revisor.index')->with('error', 'Non puoi approvare i tuoi stessi annunci.');
        }

        $article->update(['status' => 'approved']);
        session(['last_action' => ['id' => $article->id, 'status' => 'approved']]);

        return redirect()->route('revisor.index');
    }

    // Rifiuta annuncio
    public function reject(Article $article)
    {
        // Sicurezza: il revisore non può rifiutare i propri articoli
        if ($article->user_id === Auth::id()) {
            return redirect()->route('revisor.index')->with('error', 'Non puoi rifiutare i tuoi stessi annunci.');
        }

        $article->update(['status' => 'rejected']);
        session(['last_action' => ['id' => $article->id, 'status' => 'rejected']]);

        return redirect()->route('revisor.index');
    }

    // EXTRA: annulla ultima operazione
    public function undo()
    {
        $lastAction = session('last_action');

        if (!$lastAction) {
            return redirect()->route('revisor.index')->with('error', 'Nessuna operazione da annullare.');
        }

        Article::find($lastAction['id'])->update(['status' => 'pending']);
        session()->forget('last_action');

        return redirect()->route('revisor.index')->with('success', 'Operazione annullata.');
    }

    // Rimuove il ruolo revisore da un utente
    public function removeRevisor(User $user)
    {
        $user->update(['role' => 'user']);
        return redirect()->route('homepage')->with('success', __('messages.revisor_remove_success'));
    }
}
