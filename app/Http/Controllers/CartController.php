<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // Visualizza il carrello
    public function index()
    {
        $cartItems = CartItem::with(['article.category', 'article.images'])
            ->where('user_id', Auth::id())
            ->get();

        // Totale carrello
        $total = $cartItems->sum(fn($item) => $item->article->price);

        return view('cart.index', compact('cartItems', 'total'));
    }

    // Aggiunge un articolo al carrello
    public function add(Article $article)
    {
        // Controlla che l'articolo sia approvato
        if ($article->status !== 'approved') {
            return redirect()->back()->with('error', __('messages.cart_error'));
        }

        // Controlla che l'utente non stia comprando il proprio articolo
        if ($article->user_id === Auth::id()) {
            return redirect()->back()->with('error', __('messages.cart_own_article'));
        }

        // firstOrCreate evita duplicati grazie al unique constraint
        CartItem::firstOrCreate([
            'user_id'    => Auth::id(),
            'article_id' => $article->id,
        ]);

        return redirect()->back()->with('success', __('messages.cart_added'));
    }

    // Rimuove un articolo dal carrello
    public function remove(CartItem $cartItem)
    {
        // Verifica che il cart item appartenga all'utente loggato
        if ($cartItem->user_id !== Auth::id()) {
            abort(403);
        }

        $cartItem->delete();

        return redirect()->back()->with('success', __('messages.cart_removed'));
    }

    // Svuota il carrello
    public function clear()
    {
        CartItem::where('user_id', Auth::id())->delete();

        return redirect()->back()->with('success', __('messages.cart_cleared'));
    }

    // Pagina checkout con riepilogo ordine
    public function checkout()
    {
        $cartItems = CartItem::with(['article.category', 'article.images'])
            ->where('user_id', Auth::id())
            ->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index');
        }

        $total = $cartItems->sum(fn($item) => $item->article->price);

        return view('cart.checkout', compact('cartItems', 'total'));
    }
}
