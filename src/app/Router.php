<?php

declare(strict_types=1);

namespace App;

use App\Exceptions\RouteNotFoundException;

class Router {
    private array $routes = [];

    public function __construct()
    {
        
    }

    public function get(string $path, Callable|array $cb): void
    {
        $this->routes['GET']["~^{$path}$~"] = function ($m) use ($cb) {
            $o = new $cb[0];
            return call_user_func_array([$o, $cb[1]], array_slice($m, 1));
        };
    }

    public function handle(string $method, string $path): void
    {
        $ret = preg_replace_callback_array($this->routes[$method], $path);
        if ($ret == $path) {
            throw new RouteNotFoundException();
        }

        # render
        echo "RET: {$ret}";
    }
}
