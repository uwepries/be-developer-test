<?php

declare(strict_types=1);

namespace App\Controller;

class IndexController {

    public function index(): string
    {
        return "index/index";
    }

    public function crop(string $img, int $width, int $height): string
    {
        return "index/crop({$img}, {$width}, {$height})";
    }

    public function resize(string $img, int $width, int $height): string
    {
        return "index/resize({$img}, {$width}, {$height})";
    }
}
