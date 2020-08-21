<?php

namespace App\Http\Middleware;


use Core\Http\Contracts\MiddlewareContract;
use Core\Session\SessionManager;
use Symfony\Component\HttpFoundation\Request;

class CheckCsrfToken implements MiddlewareContract
{
    protected $excludedRoutes = [];


    /**
     * @param Request $request
     * @return void
     * @throws \Exception
     */
    public function handle(Request $request)
    {
        /** @var SessionManager $session */
        $session    = $request->getSession();
        $inputToken = $request->request->get($session->getTokenKey());


        if ($request->getMethod() == 'POST' && !$session->tokenIsValid($inputToken)) {
            throw new \Exception('Token mismatch');
        }

        return;
    }
}