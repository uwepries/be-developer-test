<?php

declare(strict_types=1);

namespace App\Controller;
use App\Models\Image;
use App\Services\ImageResizeService;

class IndexController {

    public function index(): void
    {
        $title = "A resized and a cropped image";
        $resized_image = "/cat-323262_1920.jpg/resize/width/640/height/480";
        $cropped_image = "/cat-323262_1920.jpg/crop/width/640/height/480/x/200/y/200";
        include VIEWS_ROOT . "index/index.php";
    }

    public function crop(string $img, int $width, int $height, ?int $offsetX = 0, ?int $offsetY = 0): void
    {
        $imageResizeService = new ImageResizeService();
        $imageResizeService->crop(new Image(DOC_ROOT . "/assets/img/{$img}"), $width, $height, $offsetX, $offsetY);
    }

    public function resize(string $img, int $width, int $height): void
    {
        $imageResizeService = new ImageResizeService();
        $imageResizeService->resize(new Image(DOC_ROOT . "/assets/img/{$img}"), $width, $height);
    }
}
