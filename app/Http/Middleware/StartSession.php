<?php

namespace App\Http\Middleware;


use App\Http\Request;
use Core\Http\Contracts\MiddlewareContract;
use Core\Session\SessionManager;

class StartSession implements MiddlewareContract
{
    /**
     * @param Request $request
     * @return void
     */
    public function handle(Request $request)
    {
        $request->setSession(
            app(SessionManager::class)
        );

        $request->getSession()->start();
     }
}