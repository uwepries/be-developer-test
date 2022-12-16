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
        $cropped_image = "/cat-1045782_1920.jpg/crop/width/640/height/480/x/350/y/180";
        include VIEWS_ROOT . "index/index.php";
    }

    public function crop(string $img, int $width, int $height, ?int $offsetX = 0, ?int $offsetY = 0): void
    {
        $in = new Image(DOC_ROOT . "/assets/img/{$img}");
        $img_out = strtr($img, [".jpg" => "-{$width}x{$height}+{$offsetX}+{$offsetY}.jpg"]);
        $out = new Image(DOC_ROOT . "/assets/thumb/{$img_out}");
        $imageResizeService = new ImageResizeService();
        $imageResizeService->crop($in, $width, $height, $out, $offsetX, $offsetY);

        header("Location: {$out->getFrontendPath()}");
    }

    public function resize(string $img, int $width, int $height): void
    {
        $in = new Image(DOC_ROOT . "/assets/img/{$img}");
        $img_out = strtr($img, [".jpg" => "-{$width}x{$height}.jpg"]);
        $out = new Image(DOC_ROOT . "/assets/thumb/{$img_out}");
        $imageResizeService = new ImageResizeService();
        $imageResizeService->resize($in, $width, $height, $out);

        header("Location: {$out->getFrontendPath()}");
    }
}
