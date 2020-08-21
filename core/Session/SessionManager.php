<?php

namespace Core\Session;


use Symfony\Component\HttpFoundation\Session\Session;

class SessionManager extends Session
{
    protected $tokenLength = 10;
    /**
     * Key, used to check requests
     * @var string
     *
     */
    protected $tokenKey = '_token';

    public function regenerateToken()
    {
        $this->set($this->tokenKey, str_random($this->tokenLength));
    }

    public function getTokenKey()
    {
        return $this->tokenKey;
    }

    /**
     * Generates & returns new token for the form field
     * @return mixed
     */
    public function token()
    {
        $this->regenerateToken();

        return $this->get($this->tokenKey);
    }

    public function tokenIsValid($token): bool
    {
        return $this->get($this->tokenKey) == $token;
    }
}