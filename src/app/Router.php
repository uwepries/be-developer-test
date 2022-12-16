<?php

declare(strict_types=1);

namespace App;

use App\Exceptions\RouteNotFoundException;

class Router {
    private array $routes = [];

    public function get(string $path, Callable|array $cb): void
    {
        $this->routes['GET']["~^{$path}$~"] = function ($m) use ($cb) {
            return call_user_func_array([new $cb[0], $cb[1]], array_slice($m, 1));
        };
    }

    public function handle(string $method, string $path): void
    {
        $ret = preg_replace_callback_array($this->routes[$method], $path);

        # no replace == no route matched
        if ($ret == $path) {
            throw new RouteNotFoundException("Route \"{$path}\" not found", 404);
        }
    }
}
