<?php

namespace Core\Providers;


use Core\Validation\Translator;
use Illuminate\Container\Container;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Translation\FileLoader;
use Illuminate\Validation\Factory as ValidationFactory;


class ValidationServiceProvider
{
    public function register(Container $container)
    {
        $container->bind('validation', function (Container $container)  {
            $loader     = new FileLoader(new Filesystem, __DIR__ . '/../../resources/lang');
            $translator = new Translator($loader, 'en');

            return new ValidationFactory($translator, $container);
        });
    }
}