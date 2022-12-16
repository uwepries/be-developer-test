<?php

declare(strict_types=1);

namespace App\Interfaces;

interface Resizeable
{
    public function resize(int $width, int $height): \GdImage;
}