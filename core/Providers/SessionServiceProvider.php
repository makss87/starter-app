<?php
namespace Core\Providers;


use Core\Session\SessionManager;
use Illuminate\Container\Container;
use Symfony\Component\HttpFoundation\Session\Attribute\AttributeBag;
use Symfony\Component\HttpFoundation\Session\Storage\NativeSessionStorage;

class SessionServiceProvider
{
    public function register(Container $container)
    {
        $container->singleton(SessionManager::class, function () {
            $session = new SessionManager(new NativeSessionStorage(), new AttributeBag());

            return $session;
        });
    }
}