<?php

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../core/bootstrap.php';


use App\Http\Kernel;
use App\Http\Request;


Request::enableHttpMethodParameterOverride();

$container->make(Kernel::class)
    ->handle(Request::createFromGlobals());



