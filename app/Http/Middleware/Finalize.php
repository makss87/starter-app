<?php

namespace App\Http\Middleware;


use App\Http\Request;
use Core\Http\Contracts\MiddlewareContract;

class Finalize implements MiddlewareContract
{

    /**
     * @param Request $request
     * @return void
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function handle(Request $request)
    {
        session()->set('previous', $request->getPathInfo());
        session()->getFlashBag()->clear();
    }
}