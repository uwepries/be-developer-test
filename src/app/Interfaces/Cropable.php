<?php

declare(strict_types=1);

namespace App\Interfaces;

interface Cropable
{
    public function crop(int $width, int $height, ?int $offsetX = 0, ?int $offsetY = 0): \GdImage;
}
