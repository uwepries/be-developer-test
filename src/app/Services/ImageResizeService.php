<?php

declare(strict_types=1);

namespace App\Services;

use App\Interfaces\Cropable;
use App\Interfaces\Resizeable;
use App\Models\Image;

class ImageResizeService
{
    public function __construct()
    {
        
    }

    public function resize(Resizeable $image, int $width, int $height): void
    {
        // Content type
        header('Content-Type: image/jpeg');

        $thumb = $image->resize($width, $height);

        // Output
        imagejpeg($thumb);
    }

    public function crop(Cropable $image, int $width, int $height, ?int $offsetX = 0, ?int $offsetY = 0): void
    {
        // Content type
        header('Content-Type: image/jpeg');

        $thumb = $image->crop($width, $height, $offsetX, $offsetY);

        // Output
        imagejpeg($thumb);
    }
}
