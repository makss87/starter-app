<?php

namespace Core;

use Illuminate\Container\Container;
use Symfony\Component\HttpFoundation\RedirectResponse;

class Router
{

    public $routes = [
        'GET'  => [],
        'POST' => [],
        'PUT' => [],
    ];

    /** @var Container */
    private $container;

    /**
     * Router constructor.
     * @param $container
     */
    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    /**
     * @param $routes
     * @return $this
     */
    public function load($routes)
    {
        $router = $this;

        require $routes;

        return $this;
    }

    public function direct($uri, $requestType)
    {
        foreach ($this->routes[$requestType] as $route => $action) {
            if ($route == $uri)
                return $this->callAction($action);

            $pattern = str_replace('{:id}', '([\d]+)', $route);

            preg_match('~' . $pattern . '~', $uri, $matches);

            if (isset($matches[1])) {
                return $this->callAction($action, $matches[1]);
            }
        }

        throw new \Exception('Route not defined');
    }

    /**
     * @param string $type
     * @param $uri
     * @param $controller
     */
    private function register($uri, $controller, $type = 'GET')
    {
        $this->routes[$type][$uri] = $controller;

        $this->container->bindMethod($controller, function ($controller, $container) {
            [$class, $method] = explode('@', $controller);

            $contr = "App\\Controllers\\{$class}";

            return $contr->{$method}();
        });

    }

    public function get($uri, $controller)
    {
        $this->register($uri, $controller);
    }

    public function post($uri, $controller)
    {
        $this->register($uri, $controller, 'POST');
    }

    public function put($uri, $controller)
    {
        $this->register($uri, $controller, 'PUT');
    }

    private function callAction($controller, $param=null)
    {
        $contr = "App\\Controllers\\{$controller}";

        return $this->container->call($contr, ['parameterValue' => $param]);
    }

    public function redirect($path)
    {
        return (new RedirectResponse(url($path)))->send();
    }

    public function redirectBack()
    {
        $redirect = session()->get('previous');

        if ($redirect) {
            $response = new RedirectResponse($redirect);

            $response->send();
        }
    }


}