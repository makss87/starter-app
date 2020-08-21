<?php

namespace Core\Http\Contracts;



use App\Http\Request;

interface MiddlewareContract
{
    /**
     * @param Request $request
     * @return void
     */
    public function handle(Request $request);
}