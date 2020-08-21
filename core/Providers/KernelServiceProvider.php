<?php

namespace Core\Providers;


use App\Http\Kernel;
use Core\Router;
use Illuminate\Container\Container;

class KernelServiceProvider
{
    public function register(Container $container)
    {
        $container->bind(Kernel::class, function (Container $container) {
            $kernel = new Kernel($container, $container->make(Router::class));

            return $kernel;
        });
    }
}