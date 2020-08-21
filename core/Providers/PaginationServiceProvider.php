<?php

namespace Core\Providers;


use Core\Database\Paginator;
use Illuminate\Container\Container;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class PaginationServiceProvider
{
    public function register(Container $container)
    {
        $container->bind(LengthAwarePaginator::class, Paginator::class);
    }
}