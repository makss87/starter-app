<?php

namespace App\Http;

use App\Http\Middleware\CheckCsrfToken;
use App\Http\Middleware\Finalize;
use App\Http\Middleware\HandleErrors;
use App\Http\Middleware\ShareFlashData;
use App\Http\Middleware\StartSession;
use Core\Http\Kernel as HttpKernel;


class Kernel extends HttpKernel
{
    /**
     * Ordering is important
     * Executed before request handled
     * @var array
     */
    protected $registeredMiddleware = [
        StartSession::class,
        ShareFlashData::class,
        CheckCsrfToken::class,
        HandleErrors::class,
    ];

    /**
     * Executed after request handled
     * @var array
     */
    protected $registeredAfterMiddleware = [
        Finalize::class,
    ];
}
