<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['user_id', 'article_id'])]
class CartItem extends Model
{
    // Appartiene a un utente
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Appartiene a un articolo
    public function article()
    {
        return $this->belongsTo(Article::class);
    }
}
