<?php

declare(strict_types = 1);

use App\Router;
use App\Controller\IndexController;

require_once __DIR__ . '/../vendor/autoload.php';

define("DOC_ROOT", __DIR__);
define("VIEWS_ROOT", __DIR__ . '/../views/');

$router = new Router();

$router->get('/', [IndexController::class, 'index']);
$router->get('/([\w\-]+\.\w+)/crop/width/(\d+)/height/(\d+)', [IndexController::class, 'crop']);
$router->get('/([\w\-]+\.\w+)/crop/width/(\d+)/height/(\d+)/x/(\d+)/y/(\d+)', [IndexController::class, 'crop']);
$router->get('/([\w\-]+\.\w+)/resize/width/(\d+)/height/(\d+)', [IndexController::class, 'resize']);

try {
    $router->handle($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);
} catch (Exception $ex) {
    echo $ex->getMessage();
}
