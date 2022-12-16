<?php

declare(strict_types=1);

namespace App\Controller;

abstract class Controller {
    const DOC_ROOT = __DIR__ . '/../../public';
    const VIEWS_ROOT = __DIR__ . '/../../views';

    public function render(string $path, array $vars): void
    {
        extract($vars);
        include self::VIEWS_ROOT . "/{$path}.php";
    }
}
