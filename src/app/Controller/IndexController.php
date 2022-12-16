<?php

declare(strict_types=1);

namespace App\Controller;
use App\Exceptions\ImageResizeServiceException;
use App\Models\Image;
use App\Services\ImageResizeService;

class IndexController extends Controller {

    public function index(): void
    {
        $this->render("index/index", [
            'title' => "A resized and a cropped image",
            'resized_image' => "/cat-323262_1920.jpg/resize/width/640/height/480",
            'cropped_image' => "/cat-1045782_1920.jpg/crop/width/640/height/480/x/350/y/180",
        ]);
    }

    public function crop(string $img, int $width, int $height, ?int $offsetX = 0, ?int $offsetY = 0): void
    {
        $in = new Image(self::DOC_ROOT . "/assets/img/{$img}");
        $out = new Image(self::DOC_ROOT . "/assets/thumb/" . strtr($img, [".jpg" => "-{$width}x{$height}+{$offsetX}+{$offsetY}.jpg"]));

        $imageResizeService = new ImageResizeService();
        if (!$imageResizeService->crop($in, $width, $height, $out, $offsetX, $offsetY)) {
            throw new ImageResizeServiceException("Could not crop " . $in->getFrontendPath()); 
        }

        header("Location: {$out->getFrontendPath()}");
    }

    public function resize(string $img, int $width, int $height): void
    {
        $in = new Image(self::DOC_ROOT . "/assets/img/{$img}");
        $out = new Image(self::DOC_ROOT . "/assets/thumb/" . strtr($img, [".jpg" => "-{$width}x{$height}.jpg"]));

        $imageResizeService = new ImageResizeService();
        if (!$imageResizeService->resize($in, $width, $height, $out)) {
            throw new ImageResizeServiceException("Could not resize " . $in->getFrontendPath());
        }

        header("Location: {$out->getFrontendPath()}");
    }
}
