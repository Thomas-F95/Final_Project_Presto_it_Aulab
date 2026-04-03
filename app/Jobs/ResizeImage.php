<?php

namespace App\Jobs;

use App\Models\Image;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Log;
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
        public Image $image
    ) {}

    public function handle(): void
    {
        $path = storage_path('app/public/' . $this->image->path);

        $dims = getimagesize($path);
        Log::info("[ResizeImage] Avvio - dimensioni: {$dims[0]}x{$dims[1]}");

        $watermarkPath = public_path('images/watermark.png');

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

        Log::info("[ResizeImage] Completato - immagine salvata a 400x400.");
    }
}
