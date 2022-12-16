<?php

declare(strict_types=1);

namespace App\Models;

use App\Interfaces\Cropable;
use App\Interfaces\Resizeable;

class Image implements Cropable, Resizeable
{
    public function __construct(private ?string $pathToImage)
    {
        
    }

    public function getFrontendPath()
    {
        return substr($this->pathToImage, strpos($this->pathToImage, '/assets'));   
    }

    public function getFullPath()
    {
        return $this->pathToImage;   
    }

    public function crop(int $width, int $height, ?int $offsetX = 0, ?int $offsetY = 0): \GdImage
    {
        // Load
        $source = imagecreatefromjpeg($this->pathToImage);

        // Resize
        $thumb = imagecrop($source, ['x' => $offsetX, 'y' => $offsetY, 'width' => $width, 'height' => $height]);

        return $thumb;
    }

    public function resize(int $width, int $height): \GdImage
    {
        // Get orig sizes
        list($w, $h) = getimagesize($this->pathToImage);

        // Load
        $source = imagecreatefromjpeg($this->pathToImage);

        // Create
        $thumb = imagecreatetruecolor($width, $height);

        // Resize
        imagecopyresized($thumb, $source, 0, 0, 0, 0, $width, $height, $w, $h);

        return $thumb;
    }
}