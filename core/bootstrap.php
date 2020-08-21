<?php

use Illuminate\Container\Container;
use Illuminate\Filesystem\Filesystem;


$container = Container::getInstance();

$filesystem = new Filesystem();

$providers = $filesystem->getRequire(__DIR__ . '/../config/providers.php');

foreach ($providers as $provider) {
    $container->call($provider . '@register', compact('container','filesystem'));
}