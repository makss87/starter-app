<?php

namespace App\Http;


use App\Exceptions\InputValidationException;
use Illuminate\Contracts\Container\BindingResolutionException as BindingResolutionExceptionAlias;
use Symfony\Component\HttpFoundation\Request as HttpRequest;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBag;

class Request extends HttpRequest
{

    /**
     * @param $rules
     * @throws InputValidationException
     * @throws BindingResolutionExceptionAlias
     */
    public function validate($rules): void
    {
        $validator = app('validation')->make($this->all(), $rules);

        if ($validator->fails()) {
            $this->getSession()->getFlashBag()->set('errors', $validator->errors()->messages());

            $this->getSession()->getFlashBag()->set('old', $this->all());

            throw new InputValidationException();
        }
    }

    public function all(): array
    {
        return $this->getRealMethod() == 'GET' ? $this->query->all() : $this->request->all();
    }

    public function has($key): bool
    {
        return $this->getRealMethod() == 'GET' ? $this->query->has($key) : $this->request->has($key);
    }


    public function getValidationErrors()
    {
        return $this->getBagByKey('errors');
    }

    public function getOldInput()
    {
        return $this->getBagByKey('old');
    }

    public function getBagByKey($key)
    {
        $bag = new FlashBag();

        if (session()->getFlashBag()->has($key)){
            $bag->setAll(session()->getFlashBag()->get($key));
        }

        return $bag;
    }
}