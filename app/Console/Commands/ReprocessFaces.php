<?php

namespace App\Console\Commands;

use App\Jobs\RemoveFaces;
use App\Models\Image;
use Illuminate\Console\Command;

class ReprocessFaces extends Command
{
    protected $signature = 'images:reprocess-faces';
    protected $description = 'Rielabora tutte le immagini esistenti per oscurare i volti';

    public function handle(): void
    {
        $images = Image::all();

        $this->info("Trovate {$images->count()} immagini, avvio rielaborazione...");

        foreach ($images as $image) {
            RemoveFaces::dispatch($image);
            $this->info("Job dispatchiato per immagine ID: {$image->id}");
        }

        $this->info("Tutti i job sono stati inviati alla coda!");
    }
}
