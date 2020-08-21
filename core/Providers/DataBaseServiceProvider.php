<?php

namespace Core\Providers;


use Core\Database\Manager;
use Illuminate\Container\Container;

class DataBaseServiceProvider
{

    public function register(Container $container)
    {
        $database = new Manager(
            $container->make('config')->get('database')
        );

        $container->singleton('Database', function (Container $container) use($database) {
            return $database;
        });
    }
}