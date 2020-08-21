<?php
namespace Core\Providers;


use Illuminate\Events\Dispatcher;
use Illuminate\Container\Container;
use Illuminate\Filesystem\Filesystem;
use Illuminate\View\Compilers\BladeCompiler;
use Illuminate\View\Engines\CompilerEngine;
use Illuminate\View\Engines\EngineResolver;
use Illuminate\View\Engines\PhpEngine;
use Illuminate\View\Factory;
use Illuminate\View\FileViewFinder;

class ViewServiceProvider
{
    public function register(Container $container)
    {

        $container->singleton('view', function () {
            $pathsToTemplates        = [__DIR__ . '/../../resources/views'];
            $pathToCompiledTemplates = __DIR__ . '/../../resources/views/cache';

            $filesystem = new Filesystem;

            $eventDispatcher = new Dispatcher(new Container);

            $viewResolver  = new EngineResolver;
            $bladeCompiler = new BladeCompiler($filesystem, $pathToCompiledTemplates);

            $viewResolver->register('blade', function () use ($bladeCompiler) {
                return new CompilerEngine($bladeCompiler);
            });

            $viewResolver->register('php', function () {
                return new PhpEngine;
            });

            $viewFinder = new FileViewFinder($filesystem, $pathsToTemplates);

            return new Factory($viewResolver, $viewFinder, $eventDispatcher);
        });
    }
}