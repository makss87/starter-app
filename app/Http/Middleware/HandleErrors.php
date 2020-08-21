<?php
/**
 * Date: 2020-08-19
 * Time: 21:24
 */

namespace App\Http\Middleware;


use App\Exceptions\AuthenticationException;
use App\Exceptions\AuthorizationException;
use App\Exceptions\InputValidationException;
use App\Http\Request;
use Core\Http\Contracts\MiddlewareContract;
use Core\Router;
use Symfony\Component\HttpFoundation\RedirectResponse;

class HandleErrors implements MiddlewareContract
{
    /** @var Router  */
    protected $router;

    /**
     * HandleErrors constructor.
     */
    public function __construct()
    {
        $this->router = app(Router::class);
    }


    /**
     * @param Request $request
     * @return void
     */
    public function handle(Request $request)
    {
        error_reporting(-1);
        ini_set('display_errors', 'Off');
        set_exception_handler([$this, 'handleException']);
    }

    public function handleException(\Throwable $e)
    {
        if ($e instanceof AuthenticationException) {
            session()->getFlashBag()->set('authentication', $e->getMessage());

            $this->router->redirectBack();
        }

        if ($e instanceof AuthorizationException) {
            $this->router->redirect('/login');
        }

        if ($e instanceof InputValidationException) {

            $this->router->redirectBack();
        }
        throw $e;
    }


}