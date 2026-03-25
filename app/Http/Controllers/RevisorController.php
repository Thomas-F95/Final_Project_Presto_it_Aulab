<?php

namespace App\Http\Controllers;

use App\Models\Article;
// use Illuminate\Http\Request;

class RevisorController extends Controller
{
    // Lista annunci da revisionare — uno alla volta dal meno recente
    public function index()
    {
        $article = Article::with(['category', 'user'])
            ->pending()
            ->orderBy('created_at', 'asc')
            ->first();

        return view('revisor.index', compact('article'));
    }

    // Approva annuncio
    public function approve(Article $article)
    {
        $article->update(['status' => 'approved']);

        // Salva l'ultima operazione in sessione per l'undo (EXTRA)
        session(['last_action' => ['id' => $article->id, 'status' => 'approved']]);

        return redirect()->route('revisor.index');
    }

    // Rifiuta annuncio
    public function reject(Article $article)
    {
        $article->update(['status' => 'rejected']);

        // Salva l'ultima operazione in sessione per l'undo (EXTRA)
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

        // Riporta l'annuncio a pending
        Article::find($lastAction['id'])->update(['status' => 'pending']);

        // Pulisce la sessione
        session()->forget('last_action');

        return redirect()->route('revisor.index')->with('success', 'Operazione annullata.');
    }
}
