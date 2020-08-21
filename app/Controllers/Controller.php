<?php

namespace App\Controllers;


use App\Exceptions\AuthorizationException;
use Core\Router;

class Controller
{
    public function authorize()
    {
        if ( !session('authenticated')) {
            throw new AuthorizationException();
        }
    }

    public function redirect($path)
    {
        return app(Router::class)->redirect($path);
    }
}