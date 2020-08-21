<?php

namespace Core\Http;


use App\Http\Request;
use Core\Http\Contracts\MiddlewareContract;
use Core\Router;
use Illuminate\Container\Container;
use Illuminate\Contracts\Foundation\Application;

class Kernel
{
    /**
     * @var Application
     */
    private $app;
    /**
     * @var Router
     */
    private $router;

    /**
     * Ordering is important
     * Executed before request handled
     * @var array
     */
    protected $registeredMiddleware;

    /**
     * Executed after request handled
     * @var array
     */
    protected $registeredAfterMiddleware;

    /**
     * Kernel constructor.
     * @param Container $app
     * @param Router $router
     */
    public function __construct(Container $app, Router $router)
    {
        $this->app    = $app;
        $this->router = $router;
    }

    /**
     * @param Request $request
     * @throws \Exception
     */
    public function handle(Request $request)
    {
        $this->app->singleton(Request::class, function () use ($request) {
            return $request;
        });

        $this->registerGlobalMiddleware($request);

        $this->processMiddleware();

        $this->router->load(__DIR__ . '/../../app/Http/routes.php')
            ->direct($request->getPathInfo(), $request->getMethod());

        $this->finalize();
    }

    private function registerGlobalMiddleware($request)
    {
        $registered = array_merge($this->registeredMiddleware, $this->registeredAfterMiddleware);

        foreach ($registered as $middleware) {
            if ( !class_implements($middleware, MiddlewareContract::class)) {
                throw new \Exception('Middleware should implement ' . MiddlewareContract::class . ' contract');
            }

            $this->app->bindMethod($middleware . '@handle', function ($middleware) use ($request) {
                return $middleware->handle($request);
            });
        }
    }

    /**
     * Executing middleware logic in their sequence before request
     */
    private function processMiddleware()
    {
        foreach ($this->registeredMiddleware as $middleware) {
            $this->app->call($middleware . '@handle');
        }
    }

    /**
     * Executing middleware logic after request is processed
     */
    private function finalize()
    {
        foreach ($this->registeredAfterMiddleware as $middleware) {
            $this->app->call($middleware . '@handle');
        }
    }
}