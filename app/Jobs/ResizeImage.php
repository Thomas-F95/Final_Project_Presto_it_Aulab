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
use Spatie\Image\Enums\AlignPosition;


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

        // Percorso assoluto del logo watermark
        $watermarkPath = public_path('images/watermark.png');

        // Crop centrato a 400x400 e applica il watermark in basso a destra
        SpatieImage::load($path)
            ->fit(Fit::Crop, 400, 400)
            ->watermark(
                $watermarkPath,
                AlignPosition::BottomRight,
                paddingX: 10,
                paddingY: 10,
                width: 80,
                height: 40,
            )
            ->save($path);
    }
}
