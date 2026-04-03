<?php

namespace App\Jobs;

use App\Models\Image;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Google\Cloud\Vision\V1\Client\ImageAnnotatorClient;
use Google\Cloud\Vision\V1\AnnotateImageRequest;
use Google\Cloud\Vision\V1\BatchAnnotateImagesRequest;
use Google\Cloud\Vision\V1\Feature;
use Google\Cloud\Vision\V1\Feature\Type;
use Google\Cloud\Vision\V1\Image as GImage;

class RemoveFaces implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 3;

    public function __construct(public Image $image) {}

    public function handle(): void
    {
        $path = storage_path('app/public/' . $this->image->path);

        Log::info("[RemoveFaces] Avvio job per immagine ID: {$this->image->id}");
        Log::info("[RemoveFaces] Path calcolato: {$path}");

        if (!file_exists($path)) {
            Log::warning("[RemoveFaces] File NON trovato, job interrotto.");
            return;
        }

        $dims = getimagesize($path);
        Log::info("[RemoveFaces] Dimensioni immagine: {$dims[0]}x{$dims[1]}");

        Log::info("[RemoveFaces] File trovato, procedo con Google Vision.");

        $imageAnnotator = new ImageAnnotatorClient([
            'credentials' => base_path('google_credential.json'),
        ]);

        try {
            $imageContent = file_get_contents($path);

            $gImage = (new GImage())->setContent($imageContent);
            $feature = (new Feature())->setType(Type::FACE_DETECTION);

            $request = (new AnnotateImageRequest())
                ->setImage($gImage)
                ->setFeatures([$feature]);

            $batchRequest = (new BatchAnnotateImagesRequest())
                ->setRequests([$request]);

            $response = $imageAnnotator->batchAnnotateImages($batchRequest);
            $responses = $response->getResponses();

            $annotation = $responses[0]->getFaceAnnotations();

            Log::info("[RemoveFaces] Volti rilevati: " . count($annotation));

            if (count($annotation) === 0) {
                Log::info("[RemoveFaces] Nessun volto trovato, nulla da oscurare.");
                return;
            }

            $mime = mime_content_type($path);
            Log::info("[RemoveFaces] Tipo immagine: {$mime}");

            $src = match ($mime) {
                'image/jpeg' => imagecreatefromjpeg($path),
                'image/png'  => imagecreatefrompng($path),
                'image/webp' => imagecreatefromwebp($path),
                default      => null,
            };

            if (!$src) {
                Log::error("[RemoveFaces] Impossibile caricare l'immagine con GD (mime: {$mime}).");
                return;
            }

            Log::info("[RemoveFaces] Immagine caricata con GD, inizio oscuramento volti.");

            foreach ($annotation as $face) {
                $vertices = $face->getBoundingPoly()->getVertices();

                $x = max(0, $vertices[0]->getX());
                $y = max(0, $vertices[0]->getY());
                $x2 = min(imagesx($src), $vertices[2]->getX());
                $y2 = min(imagesy($src), $vertices[2]->getY());
                $w = $x2 - $x;
                $h = $y2 - $y;

                Log::info("[RemoveFaces] Bounding box: x={$x}, y={$y}, w={$w}, h={$h}");

                if ($w <= 0 || $h <= 0) {
                    Log::warning("[RemoveFaces] Bounding box non valido, volto saltato.");
                    continue;
                }

                $black = imagecolorallocate($src, 0, 0, 0);
                imagefilledrectangle($src, $x, $y, $x2, $y2, $black);

                Log::info("[RemoveFaces] Rettangolo nero applicato sul volto.");
            }

            match ($mime) {
                'image/jpeg' => imagejpeg($src, $path),
                'image/png'  => imagepng($src, $path),
                'image/webp' => imagewebp($src, $path),
            };

            imagedestroy($src);

            Log::info("[RemoveFaces] Immagine salvata con volti oscurati.");
        } catch (\Exception $e) {
            Log::error("[RemoveFaces] Eccezione: " . $e->getMessage());
            throw $e;
        } finally {
            $imageAnnotator->close();
        }
    }
}
