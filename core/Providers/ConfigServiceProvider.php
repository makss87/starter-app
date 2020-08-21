<?php

namespace Core\Providers;


use Core\AppConfig;
use Illuminate\Container\Container;
use Illuminate\Filesystem\Filesystem;

class ConfigServiceProvider
{
    public function register(Container $container, Filesystem $filesystem)
    {
        $container->bind('config', function () use($filesystem){
            $config = new AppConfig(
                $filesystem->getRequire(__DIR__.'/../../config/app.php')
            );

            return $config;
        });
    }
}