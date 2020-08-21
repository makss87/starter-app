<?php

namespace Core\Providers;


use Core\Router;
use Illuminate\Container\Container;
use Illuminate\Filesystem\Filesystem;

class RouteServiceProvider
{
    public function register(Container $container, Filesystem $filesystem)
    {
        $container->bind(Router::class, function (Container $container) use ($filesystem) {
            $router = new Router($container, $filesystem);

            return $router;
        });
    }
}