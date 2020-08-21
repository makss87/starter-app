<?php

namespace App\Http\Middleware;


use App\Http\Request;
use Core\Http\Contracts\MiddlewareContract;

class ShareFlashData implements MiddlewareContract
{

    /**
     * Sets global variables to be used inside views
     * @param Request $request
     * @return void
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function handle(Request $request)
    {
        view()->share(
            'errors', $request->getValidationErrors()
        );
        view()->share(
            'old', $request->getOldInput()
        );
    }
}