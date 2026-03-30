<?php

namespace App\Jobs;

use App\Models\Image;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Spatie\Image\Image as SpatieImage;
use Spatie\Image\Enums\Fit;

class ResizeImage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        // Riceve il model Image da processare
        public Image $image
    ) {}

    public function handle(): void
    {
        // Percorso assoluto del file nello storage
        $path = storage_path('app/public/' . $this->image->path);

        // Crop centrato a 400x400
        SpatieImage::load($path)
            ->fit(Fit::Crop, 400, 400)
            ->save($path);
    }
}
