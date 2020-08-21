<?php

use Core\Providers\ConfigServiceProvider;
use Core\Providers\DataBaseServiceProvider;
use Core\Providers\KernelServiceProvider;
use Core\Providers\PaginationServiceProvider;
use Core\Providers\RouteServiceProvider;
use Core\Providers\SessionServiceProvider;
use Core\Providers\ValidationServiceProvider;
use Core\Providers\ViewServiceProvider;

return [
    ConfigServiceProvider::class,
    DataBaseServiceProvider::class,
    RouteServiceProvider::class,
    KernelServiceProvider::class,
    SessionServiceProvider::class,
    ViewServiceProvider::class,
    ValidationServiceProvider::class,
    PaginationServiceProvider::class,
];