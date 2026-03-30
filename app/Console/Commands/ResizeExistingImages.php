<?php

namespace App\Console\Commands;

use App\Jobs\ResizeImage;
use App\Models\Image;
use Illuminate\Console\Command;

class ResizeExistingImages extends Command
{
    protected $signature = 'app:resize-existing-images';
    protected $description = 'Croppa tutte le immagini esistenti a 400x400';

    public function handle(): void
    {
        $images = Image::all();

        foreach ($images as $image) {
            ResizeImage::dispatch($image);
            $this->info("Dispatched job per immagine ID: {$image->id}");
        }

        $this->info("Totale: {$images->count()} immagini in coda.");
    }
}
