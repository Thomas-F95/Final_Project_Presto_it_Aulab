<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;


#[Fillable(['name', 'name_en', 'name_es'])]
class Category extends Model
{
    public function articles()
    {
        return $this->hasMany(Article::class);
    }

    // Restituisce il nome nella lingua corrente
    public function getTranslatedNameAttribute(): string
    {
        $locale = app()->getLocale();

        return match ($locale) {
            'en' => $this->name_en ?? $this->name,
            'es' => $this->name_es ?? $this->name,
            default => $this->name,
        };
    }
}
