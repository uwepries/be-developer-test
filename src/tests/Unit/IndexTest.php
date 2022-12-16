<?php

declare(strict_types = 1);

namespace Tests\Unit;

use App\Controller\Controller;
use App\Controller\IndexController;
use App\Exceptions\ImageResizeServiceException;
use App\Models\Image;
use App\Services\ImageResizeService;
use PHPUnit\Framework\TestCase;

class IndexTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    /** @test */
    public function it_loads_index_index(): void
    {
        $indexController = new IndexController;
        ob_start();
        $indexController->index();
        $content = ob_get_clean();

        $this->assertStringContainsString('A resized and a cropped image', $content);
    }

    /** @test */
    public function it_crops_an_image(): void
    {
        $img = 'cat-323262_1920.jpg';
        $width = 640;
        $height = 480;
        $offsetX = 0;
        $offsetY = 0;

        $in = new Image(Controller::DOC_ROOT . "/assets/img/{$img}");
        $out = new Image(Controller::DOC_ROOT . "/assets/thumb/" . strtr($img, [".jpg" => "-{$width}x{$height}+{$offsetX}+{$offsetY}.jpg"]));

        $imageResizeService = new ImageResizeService();
        if (!$imageResizeService->crop($in, $width, $height, $out, $offsetX, $offsetY)) {
            throw new ImageResizeServiceException("Could not crop " . $in->getFrontendPath()); 
        }

        $this->assertFileExists($out->getFullPath());
    }

    /** @test */
    public function it_resizes_an_image(): void
    {
        $img = 'cat-323262_1920.jpg';
        $width = 640;
        $height = 480;

        $in = new Image(Controller::DOC_ROOT . "/assets/img/{$img}");
        $out = new Image(Controller::DOC_ROOT . "/assets/thumb/" . strtr($img, [".jpg" => "-{$width}x{$height}.jpg"]));

        $imageResizeService = new ImageResizeService();
        if (!$imageResizeService->resize($in, $width, $height, $out)) {
            throw new ImageResizeServiceException("Could not resize " . $in->getFrontendPath()); 
        }

        $this->assertFileExists($out->getFullPath());
    }
}
